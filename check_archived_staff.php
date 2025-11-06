<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "Checking archived staff members...\n";

$count = User::where('role', 'staff')->onlyTrashed()->count();
echo $count . " archived staff members found.\n";

if ($count > 0) {
    $archivedStaff = User::where('role', 'staff')->onlyTrashed()->get(['id', 'username', 'first_name', 'last_name', 'deleted_at']);
    foreach ($archivedStaff as $user) {
        echo "ID: {$user->id}, Username: {$user->username}, Name: {$user->first_name} {$user->last_name}, Archived: {$user->deleted_at->format('Y-m-d H:i:s')}\n";
    }
} else {
    echo "No archived staff members found.\n";
}