<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($subject) ? $subject : 'Message de l\'institution' }}</title>
    <style>
        /* Client-specific resets */
        body,table,td{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}
        table,td{mso-table-lspace:0pt;mso-table-rspace:0pt;}
        img{-ms-interpolation-mode:bicubic;}

        /* Basic layout */
        body{margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;color:#333}
        .email-wrapper{width:100%;background:#f4f6f8;padding:30px 0}
        .email-content{max-width:680px;margin:0 auto;background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e9eef2}
        .header{padding:20px 24px;background:linear-gradient(90deg,#0d6efd 0%, #4f8bff 100%);color:#fff;display:flex;align-items:center}
        .brand{display:flex;gap:12px;align-items:center}
        .brand img{width:64px;height:64px;object-fit:cover;border-radius:8px;border:2px solid rgba(255,255,255,0.15)}
        .brand .name{font-size:18px;font-weight:700}
        .body{padding:28px 24px 32px}
        .greeting{font-size:16px;margin-bottom:12px}
        .message{font-size:15px;line-height:1.55;color:#2f3b45;background:#f8fafc;padding:16px;border-radius:6px;border:1px solid #eef3f7}
        .footer{padding:18px 24px;background:#fbfdff;border-top:1px solid #eef3f7;font-size:13px;color:#7a8a96}

        /* Buttons */
        .cta{display:inline-block;background:#0d6efd;color:#fff;padding:10px 16px;border-radius:6px;text-decoration:none;font-weight:600;margin-top:16px}

        /* Responsive */
        @media only screen and (max-width:480px){
            .brand img{width:48px;height:48px}
            .email-content{margin:0 12px}
        }
    </style>
</head>
<body>
    <table role="presentation" class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table role="presentation" class="email-content" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td class="header">
                            <div class="brand">
                                @if(!empty($photoUrl))
                                    <img src="{{ $photoUrl }}" alt="Logo {{ $institutionName ?? 'Institution' }}">
                                @endif
                                <div>
                                    <div class="name">{{ $institutionName ?? config('app.name') }}</div>
                                    <div style="font-size:12px;opacity:0.9;margin-top:2px">Notification professionnelle</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="body">
                            <div class="greeting">Bonjour @if(!empty($name)) <strong>{{ $name }}</strong> @else cher(e) destinataire @endif,</div>

                            <div class="message">
                                {!! nl2br(e($message ?? '')) !!}
                            </div>

                            @if(!empty($actionText) && !empty($actionUrl))
                                <a href="{{ $actionUrl }}" class="cta">{{ $actionText }}</a>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            <div style="margin-bottom:8px">Ceci est un message envoyé par <strong>{{ $institutionName ?? config('app.name') }}</strong>.</div>
                            <div>Si vous ne souhaitez plus recevoir ces messages, contactez-nous à l'adresse indiquée sur notre site.</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
