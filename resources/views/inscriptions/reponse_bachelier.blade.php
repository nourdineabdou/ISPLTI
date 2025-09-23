<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Réponse inscription</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body { background: linear-gradient(135deg,#f8fafc 0%,#eef2ff 100%); min-height:100vh; display:flex; align-items:center; }
		.card-center { max-width:720px; margin:32px auto; border-radius:14px; box-shadow:0 10px 30px rgba(2,6,23,0.08); }
		.status-icon { width:72px; height:72px; display:inline-flex; align-items:center; justify-content:center; border-radius:50%; }
		.muted { color:#64748b; }
		@media (max-width:576px){ .card-center{ margin:16px; } }
	</style>
</head>
<body>
<div class="container">
	<div class="card card-center p-4">
		<div class="row g-3 align-items-center">
			<div class="col-12 col-md-3 text-center">
				@if(isset($bachelier) && $bachelier->inscription == 1)
                <div class="status-icon bg-success bg-opacity-10 text-success">
					<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
					  <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14z"/>
					  <path d="M10.97 6.97a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 0 1-1.06-1.06L9 8.5l-2.47-2.47a.75.75 0 0 1 1.06-1.06L9 7.44l1.47-1.47a.75.75 0 0 1 1.06 0z"/>
					</svg>
				</div>
				@elseif(isset($bachelier) && $bachelier->inscription == 2)

					<div class="status-icon bg-secondary bg-opacity-10 text-secondary">
						<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
						  <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14z"/>
						  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 .875-.252 1.02-.598l.088-.416c.06-.28.12-.35.36-.42l.545-.15c.294-.08.352-.176.288-.469l-.738-3.468c-.194-.897.105-1.319.808-1.319.545 0 .875.252 1.02.598l.088.416c.06.28.12.35.36.42l.545.15.082-.38-2.29-.287z"/>
						</svg>
					</div>
				@else
                    <div class="status-icon bg-success bg-opacity-10 text-success">
						<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-file-earmark-arrow-down" viewBox="0 0 16 16">
						  <path d="M8 5a.5.5 0 0 1 .5.5V9h2.5a.5.5 0 0 1 0 1H8.5v3.5a.5.5 0 0 1-1 0V10H5a.5.5 0 0 1 0-1h2.5V5.5A.5.5 0 0 1 8 5z"/>
						  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6.5L14 4.5z"/>
						</svg>
					</div>
				@endif
			</div>

			<div class="col-12 col-md-9">
				<h3 class="mb-1">
					@if(isset($bachelier) && $bachelier->inscription == 1)
                        Télécharger votre Attestation d'inscription
					@elseif(isset($bachelier) && $bachelier->inscription == 2)
					     Votre inscription est en cours d'étude
					@else
						Statut d'inscription
					@endif
				</h3>
				<p class="muted mb-3">
					@if(isset($bachelier) && $bachelier->inscription == 1)
						Votre inscription a été validée. Vous pouvez télécharger votre attestation d'inscription en cliquant sur le bouton ci-dessous.
					@elseif(isset($bachelier) && $bachelier->inscription == 2)
						Votre inscription est en cours d'étude. Merci pour votre dossier. Nous l'examinons et reviendrons vers vous dès que possible.
					@else
						Nous ne trouvons pas d'information sur votre inscription. Contactez le service des admissions si nécessaire.
					@endif
				</p>

				<div class="d-flex gap-2 flex-wrap">
					@if(isset($bachelier) && $bachelier->inscription == 1)

                    @php
							$downloadUrl = url('/inscriptions/' . ($bachelier->id ?? 'download') . '/download');
						@endphp
						<a onclick="printObject({link:'{{ route('bacheliers.attestation' , $bachelier->id) }}' , title:'Attestation dinscription'  , width:4 , height:4})" class="btn btn-success btn-lg">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download me-2" viewBox="0 0 16 16">
							  <path d="M.5 9.9a.5.5 0 0 1 .5-.4H5V1.5a.5.5 0 0 1 1 0V9.5h3.999a.5.5 0 0 1 .354.854l-4.5 4.5a.5.5 0 0 1-.707 0l-4.5-4.5A.5.5 0 0 1 .5 9.9z"/>
							</svg>
							Télécharger l'attestation PDF
						</a>
						<a href="{{ url('/') }}" class="btn btn-outline-secondary">Retour</a>
					@elseif(isset($bachelier) && $bachelier->inscription == 2)
						<button class="btn btn-outline-primary" disabled>
							<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							En attente
						</button>
						<a href="{{ url('/') }}" class="btn btn-link">Retour à l'accueil</a>
					@else
						<a href="{{ url('/') }}" class="btn btn-primary">Accueil</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets/js/scripts.js')}}"></script>
</body>
</html>
