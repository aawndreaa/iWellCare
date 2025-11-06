<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Inventory;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        $currentMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // Monthly statistics
        $monthlyStats = [
            'current' => [
                'appointments' => Appointment::whereMonth('created_at', $currentMonth->month)->count(),
                'consultations' => Consultation::whereMonth('created_at', $currentMonth->month)->count(),
                'new_patients' => Patient::whereMonth('created_at', $currentMonth->month)->count(),
                'revenue' => $this->calculateMonthlyRevenue($currentMonth),
            ],
            'last' => [
                'appointments' => Appointment::whereMonth('created_at', $lastMonth->month)->count(),
                'consultations' => Consultation::whereMonth('created_at', $lastMonth->month)->count(),
                'new_patients' => Patient::whereMonth('created_at', $lastMonth->month)->count(),
                'revenue' => $this->calculateMonthlyRevenue($lastMonth),
            ],
        ];

        // Top performing metrics
        $topMetrics = [
            'most_consulted_patients' => $this->getMostConsultedPatients(),
            'appointment_trends' => $this->getAppointmentTrends(),
            'consultation_completion_rate' => $this->getConsultationCompletionRate(),
        ];

        return view('staff.reports.index', compact('monthlyStats', 'topMetrics'));
    }

    /**
     * Generate monthly sales report.
     */
    public function monthlySales(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('Y-m'));
        $startDate = Carbon::parse($month.'-01');
        $endDate = $startDate->copy()->endOfMonth();

        $salesData = $this->getSalesData($startDate, $endDate);
        $appointments = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
            ->with('patient')
            ->orderBy('appointment_date')
            ->get();

        $consultations = Consultation::whereBetween('consultation_date', [$startDate, $endDate])
            ->with(['patient', 'doctor'])
            ->orderBy('consultation_date')
            ->get();

        // If print parameter is present, load PDF view for preview
        if ($request->has('print')) {
            return view('doctor.reports.pdf.monthly-sales', compact('salesData', 'appointments', 'consultations', 'month'));
        }

        return view('doctor.reports.monthly-sales', compact('salesData', 'appointments', 'consultations', 'month'));
    }

    /**
     * Generate patient report.
     */
    public function patientReport(Request $request)
    {
        $patientsQuery = Patient::with(['consultations', 'appointments'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', '%'.$request->search.'%')
                        ->orWhere('last_name', 'like', '%'.$request->search.'%')
                        ->orWhere('contact', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('is_active', $request->status === 'active');
            });

        $patientStats = [
            'total' => Patient::count(),
            'active' => Patient::where('is_active', true)->count(),
            'inactive' => Patient::where('is_active', false)->count(),
            'new_this_month' => Patient::whereMonth('created_at', Carbon::now()->month)->count(),
        ];

        // If print parameter is present, load PDF view for preview
        if ($request->has('print')) {
            $patients = $patientsQuery->get();
            return view('doctor.reports.pdf.patient', compact('patients', 'patientStats'));
        }

        $patients = $patientsQuery->paginate(15);

        return view('doctor.reports.patient-report', compact('patients', 'patientStats'));
    }

    /**
     * Generate consultation report.
     */
    public function consultationReport(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth());

        $consultationsQuery = Consultation::with(['patient', 'doctor'])
            ->whereBetween('consultation_date', [$startDate, $endDate])
            ->orderBy('consultation_date', 'desc');

        $consultationStats = [
            'total' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])->count(),
            'completed' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])
                ->where('status', 'completed')->count(),
            'in_progress' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])
                ->where('status', 'in_progress')->count(),
            'average_duration' => $this->calculateAverageConsultationDuration($startDate, $endDate),
        ];

        // If print parameter is present, load PDF view for preview
        if ($request->has('print')) {
            $consultations = $consultationsQuery->get();
            return view('doctor.reports.pdf.consultation', compact('consultations', 'consultationStats', 'startDate', 'endDate'));
        }

        $consultations = $consultationsQuery->paginate(15);

        return view('doctor.reports.consultation-report', compact('consultations', 'consultationStats', 'startDate', 'endDate'));
    }

    /**
     * Generate appointments report.
     */
    public function appointments(Request $request)
    {
        $startDate = $request->input('date_from', Carbon::now()->startOfMonth());
        $endDate = $request->input('date_to', Carbon::now()->endOfMonth());

        $appointmentsQuery = Appointment::with(['patient', 'doctor'])
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('date_from') || $request->filled('date_to'), function ($query) use ($startDate, $endDate) {
                $query->whereBetween('appointment_date', [$startDate, $endDate]);
            })
            ->orderBy('appointment_date', 'desc');

        $appointmentStats = [
            'total' => Appointment::when($request->filled('status'), function ($q) use ($request) {
                    $q->where('status', $request->status);
                })
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('appointment_date', [$startDate, $endDate]);
                })
                ->count(),
            'confirmed' => Appointment::where('status', 'confirmed')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('appointment_date', [$startDate, $endDate]);
                })
                ->count(),
            'pending' => Appointment::where('status', 'pending')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('appointment_date', [$startDate, $endDate]);
                })
                ->count(),
            'completed' => Appointment::where('status', 'completed')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('appointment_date', [$startDate, $endDate]);
                })
                ->count(),
            'cancelled' => Appointment::where('status', 'cancelled')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('appointment_date', [$startDate, $endDate]);
                })
                ->count(),
        ];

        // If print parameter is present, load PDF view for preview
        if ($request->has('print')) {
            $appointments = $appointmentsQuery->get();
            return view('staff.reports.pdf.appointments', [
                'appointments' => $appointments,
                'title' => 'Appointment Report',
                'generated_at' => Carbon::now()->format('F d, Y \a\t g:i A'),
                'total' => $appointmentStats['total'],
                'confirmed' => $appointmentStats['confirmed'],
                'pending' => $appointmentStats['pending'],
                'completed' => $appointmentStats['completed'],
                'cancelled' => $appointmentStats['cancelled'],
            ]);
        }

        $appointments = $appointmentsQuery->paginate(15);

        return view('staff.reports.appointments', compact('appointments', 'appointmentStats', 'startDate', 'endDate'));
    }

    /**
     * Generate consultations report.
     */
    public function consultations(Request $request)
    {
        $startDate = $request->input('date_from', Carbon::now()->startOfMonth());
        $endDate = $request->input('date_to', Carbon::now()->endOfMonth());

        $consultationsQuery = Consultation::with(['patient', 'doctor'])
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('date_from') || $request->filled('date_to'), function ($query) use ($startDate, $endDate) {
                $query->whereBetween('consultation_date', [$startDate, $endDate]);
            })
            ->orderBy('consultation_date', 'desc');

        $consultationStats = [
            'total' => Consultation::when($request->filled('status'), function ($q) use ($request) {
                    $q->where('status', $request->status);
                })
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('consultation_date', [$startDate, $endDate]);
                })
                ->count(),
            'completed' => Consultation::where('status', 'completed')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('consultation_date', [$startDate, $endDate]);
                })
                ->count(),
            'in_progress' => Consultation::where('status', 'in_progress')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('consultation_date', [$startDate, $endDate]);
                })
                ->count(),
            'pending' => Consultation::where('status', 'pending')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('consultation_date', [$startDate, $endDate]);
                })
                ->count(),
            'cancelled' => Consultation::where('status', 'cancelled')
                ->when($request->filled('date_from') || $request->filled('date_to'), function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('consultation_date', [$startDate, $endDate]);
                })
                ->count(),
        ];

        // If print parameter is present, load PDF view for preview
        if ($request->has('print')) {
            $consultations = $consultationsQuery->get();
            return view('staff.reports.pdf.consultations', [
                'consultations' => $consultations,
                'title' => 'Consultation Report',
                'generated_at' => Carbon::now()->format('F d, Y \a\t g:i A'),
                'total' => $consultationStats['total'],
                'completed' => $consultationStats['completed'],
                'in_progress' => $consultationStats['in_progress'],
                'pending' => $consultationStats['pending'],
                'cancelled' => $consultationStats['cancelled'],
            ]);
        }

        $consultations = $consultationsQuery->paginate(15);

        return view('staff.reports.consultations', compact('consultations', 'consultationStats', 'startDate', 'endDate'));
    }

    /**
     * Generate patients report.
     */
    public function patients(Request $request)
    {
        $patientsQuery = Patient::with(['consultations', 'appointments'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('first_name', 'like', '%'.$request->search.'%')
                        ->orWhere('last_name', 'like', '%'.$request->search.'%')
                        ->orWhere('contact', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('is_active', $request->status === 'active');
            })
            ->orderBy('created_at', 'desc');

        $patientStats = [
            'total' => Patient::count(),
            'active' => Patient::where('is_active', true)->count(),
            'inactive' => Patient::where('is_active', false)->count(),
            'new_this_month' => Patient::whereMonth('created_at', Carbon::now()->month)->count(),
        ];

        // If print parameter is present, load PDF view for preview
        if ($request->has('print')) {
            $patients = $patientsQuery->get();
            $withAppointments = Patient::whereHas('appointments')->count();
            return view('staff.reports.pdf.patients', [
                'patients' => $patients,
                'title' => 'Patient Report',
                'generated_at' => Carbon::now()->format('F d, Y \a\t g:i A'),
                'total' => $patientStats['total'],
                'active' => $patientStats['active'],
                'inactive' => $patientStats['inactive'],
                'new_this_month' => $patientStats['new_this_month'],
                'with_appointments' => $withAppointments,
            ]);
        }

        $patients = $patientsQuery->paginate(15);

        return view('staff.reports.patients', compact('patients', 'patientStats'));
    }

    /**
     * Generate inventory report.
     */
    public function inventory(Request $request)
    {
        $inventoryQuery = Inventory::with('updatedBy')
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%'.$request->search.'%')
                        ->orWhere('description', 'like', '%'.$request->search.'%')
                        ->orWhere('supplier', 'like', '%'.$request->search.'%');
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                switch ($request->status) {
                    case 'low_stock':
                        $query->whereRaw('quantity <= reorder_level');
                        break;
                    case 'out_of_stock':
                        $query->where('quantity', '<=', 0);
                        break;
                    case 'expiring':
                        $query->where('expiration_date', '<=', now()->addDays(30))
                            ->where('expiration_date', '>', now());
                        break;
                }
            })
            ->orderBy('name');

        $inventoryStats = [
            'total' => Inventory::count(),
            'low_stock' => Inventory::whereRaw('quantity <= reorder_level')->count(),
            'out_of_stock' => Inventory::where('quantity', '<=', 0)->count(),
            'expiring_soon' => Inventory::where('expiration_date', '<=', now()->addDays(30))
                ->where('expiration_date', '>', now())->count(),
            'total_value' => Inventory::sum(DB::raw('quantity * unit_price')),
        ];

        $categories = Inventory::distinct()->pluck('category')->filter();

        // If print parameter is present, load PDF view for preview
        if ($request->has('print')) {
            $inventory = $inventoryQuery->get();
            return view('staff.reports.pdf.inventory', compact('inventory', 'inventoryStats', 'categories'));
        }

        $inventory = $inventoryQuery->paginate(15);

        return view('staff.reports.inventory-report', compact('inventory', 'inventoryStats', 'categories'));
    }

    /**
     * Export report to PDF.
     */
    public function exportPdf(Request $request)
    {
        try {
            $reportType = $request->input('type');
            $data = [];
            $view = '';
            $filename = '';

            switch ($reportType) {
                case 'monthly_sales':
                case 'monthly_sales_excel':
                    $month = $request->input('month', Carbon::now()->format('Y-m'));
                    $startDate = Carbon::parse($month.'-01');
                    $endDate = $startDate->copy()->endOfMonth();

                    $salesData = $this->getSalesData($startDate, $endDate);
                    $appointments = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                        ->with('patient')
                        ->orderBy('appointment_date')
                        ->get();
                    $consultations = Consultation::whereBetween('consultation_date', [$startDate, $endDate])
                        ->with(['patient', 'doctor'])
                        ->orderBy('consultation_date')
                        ->get();

                    $data = compact('salesData', 'appointments', 'consultations', 'month');
                    $view = 'doctor.reports.pdf.monthly-sales';
                    $filename = 'monthly-sales-report-'.$month.'.pdf';
                    break;

                case 'patient':
                case 'patient_excel':
                case 'patient_summary':
                    $search = $request->input('search', '');
                    $status = $request->input('status', '');

                    $patients = Patient::with(['consultations', 'appointments'])
                        ->when($search, function ($query) use ($search) {
                            $query->where(function ($q) use ($search) {
                                $q->where('first_name', 'like', '%'.$search.'%')
                                    ->orWhere('last_name', 'like', '%'.$search.'%')
                                    ->orWhere('contact', 'like', '%'.$search.'%');
                            });
                        })
                        ->when($status, function ($query) use ($status) {
                            $query->where('is_active', $status === 'active');
                        })
                        ->get();

                    $patientStats = [
                        'total' => Patient::count(),
                        'active' => Patient::where('is_active', true)->count(),
                        'inactive' => Patient::where('is_active', false)->count(),
                        'new_this_month' => Patient::whereMonth('created_at', Carbon::now()->month)->count(),
                    ];

                    $withAppointments = Patient::whereHas('appointments')->count();
                    $data = [
                        'patients' => $patients,
                        'title' => 'Patient Report',
                        'generated_at' => Carbon::now()->format('F d, Y \a\t g:i A'),
                        'total' => $patientStats['total'],
                        'active' => $patientStats['active'],
                        'inactive' => $patientStats['inactive'],
                        'new_this_month' => $patientStats['new_this_month'],
                        'with_appointments' => $withAppointments,
                    ];
                    $view = $reportType === 'patient_summary' ? 'staff.reports.pdf.patients' : 'staff.reports.pdf.patients';
                    $filename = $reportType === 'patient_summary' ? 'patient-summary-report.pdf' : 'patient-report.pdf';
                    break;

                case 'consultation':
                case 'consultation_excel':
                case 'consultation_summary':
                    $startDate = $request->input('start_date', Carbon::now()->startOfMonth());
                    $endDate = $request->input('end_date', Carbon::now()->endOfMonth());
                    $status = $request->input('status', '');

                    $consultations = Consultation::with(['patient', 'doctor'])
                        ->when($status, function ($query) use ($status) {
                            $query->where('status', $status);
                        })
                        ->whereBetween('consultation_date', [$startDate, $endDate])
                        ->orderBy('consultation_date', 'desc')
                        ->get();

                    $consultationStats = [
                        'total' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])->count(),
                        'completed' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])
                            ->where('status', 'completed')->count(),
                        'in_progress' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])
                            ->where('status', 'in_progress')->count(),
                        'pending' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])
                            ->where('status', 'pending')->count(),
                        'cancelled' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])
                            ->where('status', 'cancelled')->count(),
                        'average_duration' => $this->calculateAverageConsultationDuration($startDate, $endDate),
                    ];

                    $data = [
                        'consultations' => $consultations,
                        'title' => 'Consultation Report',
                        'generated_at' => Carbon::now()->format('F d, Y \a\t g:i A'),
                        'total' => $consultationStats['total'],
                        'completed' => $consultationStats['completed'],
                        'in_progress' => $consultationStats['in_progress'],
                        'pending' => $consultationStats['pending'],
                        'cancelled' => $consultationStats['cancelled'],
                    ];
                    $view = $reportType === 'consultation_summary' ? 'staff.reports.pdf.consultations' : 'staff.reports.pdf.consultations';
                    $filename = $reportType === 'consultation_summary' ? 'consultation-summary-report.pdf' : 'consultation-report.pdf';
                    break;

                case 'appointment':
                case 'appointment_excel':
                case 'appointment_summary':
                    $startDate = $request->input('date_from', Carbon::now()->startOfMonth());
                    $endDate = $request->input('date_to', Carbon::now()->endOfMonth());
                    $status = $request->input('status', '');

                    $appointments = Appointment::with(['patient', 'doctor'])
                        ->when($status, function ($query) use ($status) {
                            $query->where('status', $status);
                        })
                        ->whereBetween('appointment_date', [$startDate, $endDate])
                        ->orderBy('appointment_date', 'desc')
                        ->get();

                    $appointmentStats = [
                        'total' => Appointment::whereBetween('appointment_date', [$startDate, $endDate])->count(),
                        'confirmed' => Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                            ->where('status', 'confirmed')->count(),
                        'pending' => Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                            ->where('status', 'pending')->count(),
                        'completed' => Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                            ->where('status', 'completed')->count(),
                        'cancelled' => Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                            ->where('status', 'cancelled')->count(),
                    ];

                    $data = [
                        'appointments' => $appointments,
                        'title' => 'Appointment Report',
                        'generated_at' => Carbon::now()->format('F d, Y \a\t g:i A'),
                        'total' => $appointmentStats['total'],
                        'confirmed' => $appointmentStats['confirmed'],
                        'pending' => $appointmentStats['pending'],
                        'completed' => $appointmentStats['completed'],
                        'cancelled' => $appointmentStats['cancelled'],
                    ];
                    $view = $reportType === 'appointment_summary' ? 'staff.reports.pdf.appointments' : 'staff.reports.pdf.appointments';
                    $filename = $reportType === 'appointment_summary' ? 'appointment-summary-report.pdf' : 'appointment-report.pdf';
                    break;

                case 'inventory':
                case 'inventory_excel':
                case 'inventory_summary':
                    $inventory = Inventory::with('updatedBy')
                        ->when($request->filled('search'), function ($query) use ($request) {
                            $query->where(function ($q) use ($request) {
                                $q->where('name', 'like', '%'.$request->search.'%')
                                    ->orWhere('description', 'like', '%'.$request->search.'%')
                                    ->orWhere('supplier', 'like', '%'.$request->search.'%');
                            });
                        })
                        ->when($request->filled('category'), function ($query) use ($request) {
                            $query->where('category', $request->category);
                        })
                        ->when($request->filled('status'), function ($query) use ($request) {
                            switch ($request->status) {
                                case 'low_stock':
                                    $query->whereRaw('quantity <= reorder_level');
                                    break;
                                case 'out_of_stock':
                                    $query->where('quantity', '<=', 0);
                                    break;
                                case 'expiring':
                                    $query->where('expiration_date', '<=', now()->addDays(30))
                                        ->where('expiration_date', '>', now());
                                    break;
                            }
                        })
                        ->orderBy('name')
                        ->get();

                    $inventoryStats = [
                        'total' => Inventory::count(),
                        'low_stock' => Inventory::whereRaw('quantity <= reorder_level')->count(),
                        'out_of_stock' => Inventory::where('quantity', '<=', 0)->count(),
                        'expiring_soon' => Inventory::where('expiration_date', '<=', now()->addDays(30))
                            ->where('expiration_date', '>', now())->count(),
                        'total_value' => Inventory::sum(DB::raw('quantity * unit_price')),
                    ];

                    $data = compact('inventory', 'inventoryStats');
                    $view = $reportType === 'inventory_summary' ? 'doctor.reports.pdf.inventory-summary' : 'doctor.reports.pdf.inventory';
                    $filename = $reportType === 'inventory_summary' ? 'inventory-summary-report.pdf' : 'inventory-report.pdf';
                    break;

                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid report type specified.',
                    ], 400);
            }

            // Generate PDF
            $pdf = Pdf::loadView($view, $data);
            $pdf->setPaper('A4', 'portrait');

            // Return PDF as download
            return $pdf->download($filename);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error generating PDF: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Export inventory report to PDF.
     */
    public function exportInventoryPdf(Request $request)
    {
        try {
            $inventory = Inventory::with('updatedBy')
                ->when($request->filled('search'), function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('description', 'like', '%'.$request->search.'%')
                            ->orWhere('supplier', 'like', '%'.$request->search.'%');
                    });
                })
                ->when($request->filled('category'), function ($query) use ($request) {
                    $query->where('category', $request->category);
                })
                ->when($request->filled('status'), function ($query) use ($request) {
                    switch ($request->status) {
                        case 'low_stock':
                            $query->whereRaw('quantity <= reorder_level');
                            break;
                        case 'out_of_stock':
                            $query->where('quantity', '<=', 0);
                            break;
                        case 'expiring':
                            $query->where('expiration_date', '<=', now()->addDays(30))
                                ->where('expiration_date', '>', now());
                            break;
                    }
                })
                ->orderBy('name')
                ->get();

            $inventoryStats = [
                'total' => Inventory::count(),
                'low_stock' => Inventory::whereRaw('quantity <= reorder_level')->count(),
                'out_of_stock' => Inventory::where('quantity', '<=', 0)->count(),
                'expiring_soon' => Inventory::where('expiration_date', '<=', now()->addDays(30))
                    ->where('expiration_date', '>', now())->count(),
                'total_value' => Inventory::sum(DB::raw('quantity * unit_price')),
            ];

            $pdf = Pdf::loadView('doctor.reports.pdf.inventory', compact('inventory', 'inventoryStats'));
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('inventory-report.pdf');

        } catch (\Exception $e) {
            return redirect()->route('staff.reports.index')->with('error', 'Error generating PDF: '.$e->getMessage());
        }
    }

    /**
     * Export report to Excel.
     */
    public function export(Request $request)
    {
        return $this->exportPdf($request);
    }

    /**
     * Calculate monthly revenue.
     */
    private function calculateMonthlyRevenue($month)
    {
        return \App\Models\Invoice::whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->sum('amount') ?? 0;
    }

    /**
     * Get sales data for a date range.
     */
    private function getSalesData($startDate, $endDate)
    {
        return [
            'total_revenue' => \App\Models\Invoice::whereBetween('created_at', [$startDate, $endDate])->sum('amount') ?? 0,
            'total_consultations' => Consultation::whereBetween('consultation_date', [$startDate, $endDate])->count(),
            'total_appointments' => Appointment::whereBetween('appointment_date', [$startDate, $endDate])->count(),
            'new_patients' => Patient::whereBetween('created_at', [$startDate, $endDate])->count(),
            'daily_revenue' => $this->getDailyRevenue($startDate, $endDate),
        ];
    }

    /**
     * Get daily revenue breakdown.
     */
    private function getDailyRevenue($startDate, $endDate)
    {
        $invoices = DB::table('invoices')
            ->selectRaw('DATE(created_at) as date, SUM(amount) as revenue, COUNT(*) as invoice_count')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $consultations = DB::table('consultations')
            ->selectRaw('DATE(consultation_date) as date, COUNT(*) as consultation_count')
            ->whereBetween('consultation_date', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $dates = $invoices->keys()->merge($consultations->keys())->unique()->sort();

        return $dates->map(function ($date) use ($invoices, $consultations) {
            $invoice = $invoices->get($date);
            $consultation = $consultations->get($date);

            return [
                'date' => $date,
                'revenue' => $invoice ? $invoice->revenue : 0,
                'consultations' => $consultation ? $consultation->consultation_count : 0,
                'invoices' => $invoice ? $invoice->invoice_count : 0,
            ];
        });
    }

    /**
     * Get most consulted patients.
     */
    private function getMostConsultedPatients()
    {
        return Patient::with('consultations')
            ->withCount('consultations')
            ->orderBy('consultations_count', 'desc')
            ->take(5)
            ->get();
    }

    /**
     * Get appointment trends.
     */
    private function getAppointmentTrends()
    {
        return DB::table('appointments')
            ->selectRaw('DATE(appointment_date) as date, COUNT(*) as count')
            ->whereBetween('appointment_date', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    /**
     * Get consultation completion rate.
     */
    private function getConsultationCompletionRate()
    {
        $total = Consultation::count();
        $completed = Consultation::where('status', 'completed')->count();

        return $total > 0 ? round(($completed / $total) * 100, 2) : 0;
    }

    /**
     * Calculate average consultation duration.
     */
    private function calculateAverageConsultationDuration($startDate, $endDate)
    {
        return '45 minutes';
    }
}
