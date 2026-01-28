<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() ?? 'ltr' }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ __('Reset Your EventNova Password') }}</title>

    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->

    <style type="text/css">
        :root { color-scheme: light dark; supported-color-schemes: light dark; }
        body, table, td, div, p, a {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        body {
            background-color: #f9fafb !important;
            color: #111827 !important;
        }

        .email-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff !important;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb !important;
        }

        .header {
            background: linear-gradient(135deg, #7c3aed, #a78bfa) !important;
            padding: 48px 32px 32px;
            text-align: center;
            color: #ffffff !important;
        }

        .header h1, .header p {
            color: #ffffff !important;
            margin: 0;
        }

        .header h1 { font-size: 28px; font-weight: 700; }
        .header p {
            font-size: 18px;
            font-weight: 500;
            margin: 12px 0 0;
            text-shadow: 0 1px 3px rgba(0,0,0,0.3);
        }

        .content {
            padding: 12px;
            text-align: center;
            background: #ffffff !important;
            color: #111827 !important;
        }

        h2 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 20px;
            color: #111827 !important;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 24px;
            color: #374151 !important;
        }

        .small {
            font-size: 14px;
            color: #6b7280 !important;
            line-height: 1.5;
        }

        .button {
            display: inline-block;
            background-color: #7c3aed !important;
            color: #ffffff !important;
            font-weight: 600;
            font-size: 18px;
            padding: 16px 40px;
            border-radius: 8px;
            text-decoration: none;
            margin: 24px 0;
        }

        .button:hover { background-color: #6d28d9 !important; }

        .fallback-link {
            color: #7c3aed !important;
            text-decoration: underline;
            word-break: break-all;
        }

        .security-notice {
            background: #fef3c7 !important;
            border-radius: 8px;
            padding: 16px;
            margin: 24px 0;
            border-left: 4px solid #f59e0b !important;
            text-align: left;
        }

        .security-notice p {
            margin: 0;
            color: #92400e !important;
            font-size: 14px;
        }

        .upcoming-events {
            background: #f0f9ff !important;
            border-radius: 8px;
            padding: 20px;
            margin: 24px 0;
            border-left: 4px solid #0ea5e9 !important;
            text-align: left;
        }

        .upcoming-events h3 {
            margin: 0 0 12px 0;
            color: #0369a1 !important;
            font-size: 16px;
        }

        .event-item {
            background: white !important;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 8px;
            border: 1px solid #e0f2fe !important;
        }

        .event-title {
            font-weight: 600;
            color: #111827 !important;
            margin-bottom: 4px;
        }

        .event-date {
            color: #7c3aed !important;
            font-size: 14px;
        }

        .footer {
            padding: 12px;
            font-size: 14px;
            color: #6b7280 !important;
            text-align: center;
            border-top: 1px solid #e5e7eb !important;
            background: #f9fafb !important;
        }

        .footer a {
            color: #7c3aed !important;
            text-decoration: none;
        }

        .footer a:hover { text-decoration: underline; }

        /* RTL adjustments */
        [dir="rtl"] .content,
        [dir="rtl"] .header,
        [dir="rtl"] .footer {
            direction: rtl;
            text-align: right;
        }

        [dir="rtl"] .button {
            margin: 24px 0;
        }

        [dir="rtl"] .security-notice,
        [dir="rtl"] .upcoming-events {
            text-align: right;
        }

        /* Dark mode – minimal */
        @media (prefers-color-scheme: dark) {
            body { background-color: #111827 !important; }
            .email-container { background: #1f2937 !important; border-color: #374151 !important; }
            .content { background: #1f2937 !important; }
            h2 { color: #f9fafb !important; }
            p { color: #d1d5db !important; }
            .small, .footer { color: #9ca3af !important; border-top-color: #374151 !important; background: #111827 !important; }
            .fallback-link { color: #c084fc !important; }
            .button { background-color: #8b5cf6 !important; }
            .header { background: linear-gradient(135deg, #6d28d9, #a78bfa) !important; }
            .header h1, .header p { text-shadow: none; }
            .security-notice { background: #451a03 !important; border-left-color: #d97706 !important; }
            .security-notice p { color: #fef3c7 !important; }
            .upcoming-events { background: #0c4a6e !important; border-left-color: #0ea5e9 !important; }
            .upcoming-events h3 { color: #7dd3fc !important; }
            .event-item { background: #1e40af !important; border-color: #1d4ed8 !important; }
            .event-title { color: #e0f2fe !important; }
            .event-date { color: #a78bfa !important; }
        }

        @media only screen and (max-width: 480px) {
            .content { width:100%; padding: 6px !important; }
            .button { width: 100% !important; box-sizing: border-box; }
            .header { padding: 32px 16px 24px !important; }
        }
    </style>
</head>
<body style="margin:0; padding:0; background-color:#f9fafb !important;">
    <table role="presentation" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td style="padding: 32px 16px; background:#f9fafb !important;">
                <table role="presentation" class="email-container" width="100%" border="0" cellspacing="0" cellpadding="0">

                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <h1>{{ __('Reset Your Password') }}</h1>
                            <p>{{ __('EventNova Account Security') }}</p>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td class="content">
                            <h2>{{ __('Reset Your EventNova Password') }}</h2>

                            <p>{{ __('Hello :name,', ['name' => $user->full_name ?? $user->name ?? 'there']) }}</p>

                            <p>{{ __('We received a request to reset the password for your EventNova account. If you made this request, click the button below to create a new password:') }}</p>

                            <a href="{{ $resetUrl }}" class="button">{{ __('Reset My Password') }}</a>

                            <div class="security-notice">
                                <p><strong>⚠️ {{ __('Security Notice:') }}</strong> {{ __('This password reset link will expire in :minutes minutes for security reasons. If you didn\'t request this reset, please ignore this email or contact our support team immediately.', ['minutes' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire', 60)]) }}</p>
                            </div>

                            <p class="small" style="margin:32px 0 16px;">
                                {{ __('If the button doesn\'t work, copy and paste this link into your browser:') }}<br>
                                <a href="{{ $resetUrl }}" class="fallback-link">{{ $resetUrl }}</a>
                            </p>

                            @if($upcomingEvents && $upcomingEvents->count() > 0)
                            <div class="upcoming-events">
                                <h3>{{ __('Your Upcoming Events') }}</h3>
                                <p style="color: #374151 !important; margin-bottom: 16px; font-size: 14px;">{{ __('Once you reset your password, you can manage these events:') }}</p>
                                @foreach($upcomingEvents as $event)
                                <div class="event-item">
                                    <div class="event-title">{{ $event->title }}</div>
                                    <div class="event-date">📅 {{ $event->start_date->format('F j, Y • g:i A') }}</div>
                                </div>
                                @endforeach
                            </div>
                            @endif

                            <p class="small">
                                {{ __('This is an automated security email. If you need help, please contact our support team.') }}
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td class="footer">
                            <p>© {{ date('Y') }} {{ __('EventNova') }}. {{ __('All rights reserved.') }}<br>{{ __('Sharm el-Sheikh, Egypt') }}</p>
                            <p style="margin:12px 0 0;">
                                <a href="{{ url('/') }}">{{ __('EventNova.com') }}</a> •
                                <a href="{{ url('/privacy') }}">{{ __('Privacy Policy') }}</a> •
                                <a href="{{ url('/terms') }}">{{ __('Terms of Service') }}</a> •
                                <a href="{{ url('/contact') }}">{{ __('Contact Support') }}</a>
                            </p>
                            <p style="margin:8px 0 0; font-size: 12px;">
                                {{ __('This email was sent to :email', ['email' => $user->email]) }}
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>