<!doctype html>
<html lang="{{ app()->getLocale() }}" @if(app()->getLocale() == 'ar') dir="rtl" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('candidature.email_refusee_titre')</title>
    <style>
        body,table,td{-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;}
        body{margin:0;padding:0;background-color:#f1f5f4;font-family:Arial,Helvetica,sans-serif;color:#212529}
        .email-wrapper{width:100%;background:#f1f5f4;padding:30px 0}
        .email-content{max-width:640px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e6ece9}
        .header{padding:26px 28px;background:linear-gradient(90deg,#2d465e 0%, #42607e 100%);color:#fff;text-align:center}
        .header img{width:56px;height:56px;object-fit:cover;border-radius:10px;border:2px solid rgba(255,255,255,0.35);margin-bottom:8px}
        .header .titre{font-size:18px;font-weight:700}
        .body{padding:32px 28px}
        .greeting{font-size:17px;margin-bottom:14px;color:#2d465e;font-weight:700}
        .numero{display:inline-block;background:#f1f5f4;color:#2d465e;font-weight:700;padding:6px 14px;border-radius:20px;font-size:14px;margin-bottom:18px}
        .message{font-size:15px;line-height:1.6;color:#42525c}
        .motif{margin-top:16px;padding:14px 16px;background:#f8fafc;border-radius:8px;border:1px solid #eef3f7;font-size:14px;color:#42525c}
        .footer{padding:18px 28px;background:#fbfdff;border-top:1px solid #eef3f7;font-size:12px;color:#8a97a0;text-align:center}
        @media only screen and (max-width:480px){ .email-content{margin:0 12px} }
    </style>
</head>
<body>
    <table role="presentation" class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
        <tr><td align="center">
            <table role="presentation" class="email-content" cellpadding="0" cellspacing="0" width="100%">
                <tr><td class="header">
                    <img src="{{ asset('logo.jpeg') }}" alt="ISPLTI">
                    <div class="titre">{{ config('app.name') }}</div>
                </td></tr>
                <tr><td class="body">
                    <div class="greeting">@lang('candidature.email_bonjour', ['nom' => $candidature->prenom . ' ' . $candidature->nom])</div>
                    <div class="numero">{{ $candidature->numero_candidature }}</div>
                    <div class="message">
                        {{ __('candidature.email_refusee_corps', ['master' => $candidature->master->intituleLocalise()]) }}
                    </div>
                    @if($candidature->commentaire_admin)
                        <div class="motif"><strong>@lang('candidature.email_refusee_motif') :</strong> {{ $candidature->commentaire_admin }}</div>
                    @endif
                    <div class="message" style="margin-top:16px;">{{ __('candidature.email_refusee_encouragement') }}</div>
                </td></tr>
                <tr><td class="footer">{{ config('app.name') }}</td></tr>
            </table>
        </td></tr>
    </table>
</body>
</html>
