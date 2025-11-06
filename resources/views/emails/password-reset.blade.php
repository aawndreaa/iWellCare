<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset - iWellCare</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #374151;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .logo {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .tagline {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .message {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }

        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.5);
        }

        .warning-box {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .warning-title {
            font-weight: 600;
            color: #92400e;
            margin-bottom: 8px;
        }

        .warning-text {
            color: #92400e;
            font-size: 14px;
            margin: 0;
        }

        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer-text {
            color: #6b7280;
            font-size: 14px;
            margin: 0 0 10px 0;
        }

        .footer-links {
            margin-top: 15px;
        }

        .footer-links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }

            .header {
                padding: 30px 20px;
            }

            .content {
                padding: 30px 20px;
            }

            .reset-button {
                display: block;
                text-align: center;
                padding: 14px 24px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <p class="tagline">Your Health, Our Priority</p>
        </div>

        <!-- Content -->
        <div class="content">
            <h1 class="greeting">Reset Your Password</h1>

            <p class="message">
                Hello {{ $user->first_name ?? 'User' }},<br><br>
                We received a request to reset your password for your iWellCare account. If you made this request, please click the button below to reset your password.
            </p>

            <div style="text-align: center;">
                <a href="{{ $url }}" class="reset-button">
                    Reset Password
                </a>
            </div>

            <div class="warning-box">
                <div class="warning-title">Important Security Notice</div>
                <p class="warning-text">
                    This password reset link will expire in 60 minutes for your security. If you didn't request this password reset, please ignore this email. Your password will remain unchanged.
                </p>
            </div>

            <p class="message">
                If the button above doesn't work, you can copy and paste this link into your browser:<br>
                <a href="{{ $url }}" style="color: #667eea; word-break: break-all;">{{ $url }}</a>
            </p>

            <p class="message">
                If you have any questions or need assistance, please don't hesitate to contact our support team.<br><br>
                Best regards,<br>
                The iWellCare Team
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">
                &copy; {{ date('Y') }} Adult Wellness Clinic and Medical. All rights reserved.
            </p>
            <div class="footer-links">
                <a href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}">Terms of Service</a>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </div>
    </div>
</body>
</html>