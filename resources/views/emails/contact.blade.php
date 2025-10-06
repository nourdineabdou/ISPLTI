<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body,table,td{font-family:Arial,Helvetica,sans-serif;color:#333}
		body{background:#f4f6f8;margin:0;padding:30px}
		.container{max-width:680px;margin:0 auto;background:#fff;border-radius:8px;overflow:hidden;border:1px solid #e9eef2}
		.header{display:flex;gap:16px;align-items:center;padding:18px 20px;background:linear-gradient(90deg,#0d6efd,#4f8bff);color:#fff}
		.logo{width:64px;height:64px;border-radius:8px;object-fit:cover;border:2px solid rgba(255,255,255,0.15)}
		.title{font-weight:700;font-size:18px}
		.body{padding:22px}
		.row{margin-bottom:12px}
		.label{font-weight:700;color:#2f3b45}
		.message-box{background:#f8fafc;padding:14px;border-radius:6px;border:1px solid #eef3f7}
		.footer{padding:14px 22px;background:#fbfdff;border-top:1px solid #eef3f7;font-size:13px;color:#7a8a96}
		@media only screen and (max-width:480px){.header{flex-direction:column;align-items:flex-start}.logo{width:48px;height:48px}}
	</style>
	<title>Nouveau message de contact</title>
</head>
<body>
	<table role="presentation" width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">
				<table role="presentation" class="container" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="header">
							@php
								// Compatibilité: accepte $data[...] ou variables individuelles
								$name = $name ?? ($data['name'] ?? '');
								$email = $email ?? ($data['email'] ?? '');
								$messageText = ($data['content'] ?? '');
								$photoUrl = "https://isplti.mr/logo.jpeg";
								$institutionName = "ISPTLI";
							@endphp

							@if(!empty($photoUrl))
								<img src="{{ $photoUrl }}" alt="{{ $institutionName }}" class="logo">
							@endif
							<div>
								<div class="title">{{ $institutionName }}</div>
								<div style="font-size:13px;opacity:0.95">L’Institut Supérieur Professionnel de Langues</div>
							</div>
						</td>
					</tr>
					<tr>
						<td class="body">
							<div class="row"><span class="label">Nom :</span> {{ $name }}</div>
							<div class="row"><span class="label">Email :</span> {{ $email }}</div>

							<div class="row"><span class="label">Message :</span>
								<div class="message-box">{!! nl2br(e($messageText)) !!}</div>
							</div>

							@if(!empty($data['phone']) || !empty($phone))
								<div class="row"><span class="label">Téléphone :</span> {{ $phone ?? $data['phone'] }}</div>
							@endif
						</td>
					</tr>
					<tr>
						<td class="footer">
							<div>Envoyé via {{ $institutionName }} — <span style="opacity:0.9">https://isplti.mr/</span></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
