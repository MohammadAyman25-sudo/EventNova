<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() ?? 'ltr' }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>{{ __('Verify Your EventNova Account') }}</title>

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
            max-width: 600px;
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
            padding: 32px;
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

        .footer {
            padding: 24px;
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
        }

        @media only screen and (max-width: 480px) {
            .content { padding: 24px !important; }
            .button { width: 100% !important; box-sizing: border-box; }
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
                            <h1>{{ __('Welcome to EventNova!') }}</h1>
                            <p>{{ __('Discover Amazing Events Near You') }}</p>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td class="content">
                            <h2>{{ __('Verify Your Email Address') }}</h2>

                            <p>{{ __('Hi :name,', ['name' => $user->full_name]) }}</p>

                            <p>{{ __('Thank you for joining EventNova! We\'re excited to help you discover and join amazing events around the world.') }}</p>

                            <p>
                                @if($user->hasRole('organizer'))
                                    {{ __('As an organizer, you can now create and manage your own events. Please verify your email to get full access.') }}
                                @else
                                    {{ __('To get started and receive your QR codes for event check-ins, please verify your email address by clicking the button below:') }}
                                @endif
                            </p>

                            <a href="{{ $verificationUrl }}" class="button">{{ __('Verify Email Address') }}</a>

                            <p class="small" style="margin:32px 0 16px;">
                                {{ __('If the button doesn\'t work, copy and paste this link into your browser:') }}<br>
                                <a href="{{ $verificationUrl }}" class="fallback-link">{{ $verificationUrl }}</a>
                            </p>

                            <p class="small">
                                {{ __('This link will expire in 60 minutes for security reasons.') }}<br>
                                {{ __('If you didn\'t create an account, you can safely ignore this email.') }}
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
                                <a href="{{ url('/terms') }}">{{ __('Terms of Service') }}</a>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>