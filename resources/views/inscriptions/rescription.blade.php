<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rescription - ISPLTI</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<style>
		body{background:#f5f8fb;font-family:Inter,system-ui,Arial,Helvetica,sans-serif}
		.bg-gradient-primary{background:linear-gradient(135deg,#1e90ff,#4facfe);}
		.card{border-radius:14px}
		#ins-stepper .step{width:36px;height:36px;border-radius:50%;background:#e9ecef;display:inline-flex;align-items:center;justify-content:center;font-weight:bold}
		#ins-stepper .step.active{background:#fff;color:#1e90ff;box-shadow:0 2px 6px rgba(0,0,0,0.12)}
		.rounded-pill{border-radius:50rem!important}
		/* Responsive tweaks */
		@media (max-width: 767.98px) {
			.bg-gradient-primary{padding:2rem 1rem!important}
			.lead{font-size:0.95rem}
			.card{margin:0 0.5rem}
			.actions-mobile{flex-direction:column-reverse;gap:0.5rem}
			.actions-mobile .btn{width:100%;display:block}
		}
		@media (min-width: 768px) and (max-width: 991.98px){
			.bg-gradient-primary{padding:3rem}
		}
	</style>
</head>
<body>
	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="card shadow-lg" style="overflow:hidden;">
					<div class="row g-0">
						<div class="col-12 col-md-5 bg-gradient-primary text-white p-5 d-flex flex-column justify-content-center">
							<h2 class="mb-3">Rescription</h2>
							<p class="lead">Un formulaire en deux étapes. Remplissez vos informations, téléversez les documents et confirmez le paiement.</p>
							<div class="mt-4">
								<span class="badge bg-light text-dark me-2">Frais: <strong>100 MRU</strong></span>
							</div>
						</div>
						<div class="col-12 col-md-7 p-4">
							<div class="px-2">
								<div id="ins-stepper" class="mb-4">
									<div class="d-flex align-items-center">
										<div class="step active me-3">1</div>
										<div class="flex-grow-1"><strong>Informations</strong></div>
										<div class="step ms-3">2</div>
										<div class="flex-grow-1"><strong>Documents</strong></div>
									</div>
								</div>

								<form id="inscriptionForm" method="POST" action="{{ route('inscriptions.update', $etudiant->id) }}" enctype="multipart/form-data">
									@csrf
									<div id="ins-step-1">
										<div class="row">
                                            {{-- nom français --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Nom</label>
                                                <input value="{{ old('nom_fr' , $etudiant->nom_fr) }}" name="nom_fr" class="form-control form-control-lg rounded-pill" readonly />
                                            </div>
                                            {{-- email --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Email</label>
                                                <input value="{{ old('email' , $etudiant->email) }}" name="email" type="email" class="form-control form-control-lg rounded-pill" required />
                                            </div>
                                            {{-- numero correspondant --}}
											<div class="mb-3 col-md-6">
												<label class="form-label">Numéro correspondant</label>
												<input value="{{ old('num_correspondant' , $etudiant->num_correspondant) }}" name="num_correspondant" class="form-control form-control-lg rounded-pill" required />
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label">Téléphone</label>
												<input value="{{ old('tel' , $etudiant->telephone) }}" name="tel" class="form-control form-control-lg rounded-pill" />
											</div>
										</div>
										<div class="d-flex justify-content-end mt-4 actions-mobile">
											<button type="button" id="ins-next" class="btn btn-primary btn-lg rounded-pill px-4">Suivant</button>
										</div>
									</div>
									<div id="ins-step-2" style="display:none;">
										<h5 class="mb-3">Documents</h5>
										<div class="mb-3">
											<label class="form-label">Attestation de réussite Année précédente</label>
											<input type="file" name="attestation_reussite" class="form-control" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Copie pièce d'identité</label>
											<input type="file" name="nni" class="form-control" required />
										</div>
										<div class="mb-3">
											<label class="form-label">Capture du paiement (100 MRU)</label>
											<input type="file" name="capture_paiement" class="form-control" required />
										</div>
                                        {{-- photo --}}
										<div class="mb-3">
											<label class="form-label">Photo</label>
											<input type="file" name="photo" class="form-control" required
                                            accept="png,jpg,jpeg,jfif,PNG,"/>
										</div>
										<div class="d-flex justify-content-between mt-4 actions-mobile">
											<button type="button" id="ins-back" class="btn btn-outline-secondary btn-lg rounded-pill px-4">Retour</button>
											<button type="submit" class="btn btn-success btn-lg rounded-pill px-4">Soumettre</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script>
	document.getElementById('ins-next').addEventListener('click', function(){

		document.getElementById('ins-step-1').style.display='none';
		document.getElementById('ins-step-2').style.display='block';
		document.querySelector('#ins-stepper .step').classList.remove('active');
		document.querySelectorAll('#ins-stepper .step')[1].classList.add('active');
	});
	document.getElementById('ins-back').addEventListener('click', function(){
		document.getElementById('ins-step-2').style.display='none';
		document.getElementById('ins-step-1').style.display='block';
		document.querySelectorAll('#ins-stepper .step')[1].classList.remove('active');
		document.querySelectorAll('#ins-stepper .step')[0].classList.add('active');
	});
	</script>
</body>
</html>

