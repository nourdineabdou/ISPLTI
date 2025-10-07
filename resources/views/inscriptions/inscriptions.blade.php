<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inscription - ISPLTI</title>
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
							<h2 class="mb-3">Inscription</h2>
								<ul class="list-unstyled">
									<li>– Un formulaire en deux étapes.</li>
									<li>– Remplissez vos informations</li>
									<li>– Téléversez les documents et confirmez le paiement.</li>
								</ul>

								{{-- Bloc QR paiement (affiche l'image si $qrPhotoUrl ou $data['qrPhotoUrl'] fourni) --}}
								@php
									$qrUrl = asset('clique.jpeg');
									$qrCodeText = '047510';
								@endphp

								@if(!empty($qrUrl))
									<div class="mt-3 text-center">
										<a href="{{ $qrUrl }}" target="_blank" rel="noopener noreferrer">
											<img src="{{ $qrUrl }}" alt="QR paiement" style="max-width:180px;width:100%;border-radius:10px;border:4px solid rgba(255,255,255,0.12);background:#fff;padding:6px;">
										</a>
										<div class="mt-2 badge bg-white text-dark" style="font-size:0.95rem;padding:8px 12px;border-radius:20px;">{{ $qrCodeText }}</div>
									</div>
								@else
									<div class="mt-3 text-center">
										<div style="max-width:180px;margin:0 auto;padding:18px;border-radius:10px;background:rgba(255,255,255,0.06);">
											<div style="color:rgba(255,255,255,0.9);font-weight:600">Paiement via Click</div>
											<div style="margin-top:8px;color:rgba(255,255,255,0.85)">Code: <strong>{{ $qrCodeText }}</strong></div>
										</div>
									</div>
								@endif

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

								<form id="inscriptionForm" method="POST" action="{{ route('inscriptions.store', $bachelier->id) }}" enctype="multipart/form-data">
									@csrf
									<div id="ins-step-1">
										<div class="row">
                                            {{-- email --}}
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label @error('email') is-invalid @enderror">Email</label>
                                                <input value="{{ old('email' , $bachelier->email) }}" name="email" type="email" class="form-control form-control-lg rounded-pill"  />
                                                @error('email')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            {{-- numero correspondant --}}
											<div class="mb-3 col-md-6">
												<label class="form-label @error('num_correspondant') is-invalid @enderror">Numéro correspondant</label>
												<input value="{{ old('num_correspondant' , $bachelier->num_correspondant) }}" name="num_correspondant" class="form-control form-control-lg rounded-pill"  />
                                                @error('num_correspondant')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label @error('tel') is-invalid @enderror">Téléphone</label>
												<input value="{{ old('tel' , $bachelier->tel) }}" name="tel" class="form-control form-control-lg rounded-pill" />
                                                @error('tel')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label">Nom (FR)</label>
												<input value="{{ old('nom_fr' , $bachelier->nom_fr) }}" name="nom_fr" class="form-control form-control-lg rounded-pill" readonly />
											</div>
                                            {{--
											<div class="mb-3 col-md-6">
												<label class="form-label">Nom (AR)</label>
												<input value="{{ old('nom_ar' , $bachelier->nom_ar) }}" name="nom_ar" class="form-control form-control-lg rounded-pill" readonly/>
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label">Date de naissance</label>
												<input value="{{ old('datn' , $bachelier->datn) }}" name="datn" type="date" class="form-control form-control-lg rounded-pill" readonly />
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label">Lieu de naissance</label>
												<input value="{{ old('lieun' , $bachelier->lieun) }}" name="lieun" class="form-control form-control-lg rounded-pill" readonly />
											</div>
                                            --}}
                                            {{--
											<div class="mb-3 col-md-6">
												<label class="form-label">Numéro BAC</label>
												<input value="{{ old('num_bac' , $bachelier->num_bac) }}" name="num_bac" class="form-control form-control-lg rounded-pill" readonly />
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label">Centre examen</label>
												<input value="{{ old('centre_examen' , $bachelier->centre_examen) }}" name="centre_examen" class="form-control form-control-lg rounded-pill" readonly />
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label">Année BAC</label>
												<input value="{{ old('annee_bac' , $bachelier->annee_bac) }}" name="annee_bac" type="number" class="form-control form-control-lg rounded-pill" readonly />
											</div>
											<div class="mb-3 col-md-6">
												<label class="form-label">Moyenne BAC</label>
												<input value="{{ old('moyenne_bac' , $bachelier->moyenne_bac) }}" name="moyenne_bac" step="0.01" type="number" class="form-control form-control-lg rounded-pill"  readonly />
											</div>
                                            --}}
											<div class="mb-3 col-md-6">
												<label class="form-label">Genre</label>
												<select name="genre" class="form-control form-control-lg rounded-pill">
													<option value="">--</option>
													<option value="M" {{ old('genre' , $bachelier->genre) == 'M' ? 'selected' : '' }}>Masculin</option>
													<option value="F" {{ old('genre' , $bachelier->genre) == 'F' ? 'selected' : '' }}>Féminin</option>
												</select>
											</div>
										</div>
										<div class="d-flex justify-content-end mt-4 actions-mobile">
											<button type="button" id="ins-next" class="btn btn-primary btn-lg rounded-pill px-4">Suivant</button>
										</div>
									</div>
									<div id="ins-step-2" style="display:none;">
										<h5 class="mb-3">Documents</h5>
										<div class="mb-3">
											<label class="form-label  @error('doc_bac') is-invalid @enderror">Document BAC</label>
											<input type="file" name="doc_bac" class="form-control"  />
                                            @error('doc_bac')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label @error('nni') is-invalid @enderror">Copie pièce d'identité</label>
											<input type="file" name="nni" class="form-control"  />
                                            @error('nni')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label">Certificat médical (pdf)</label>
											<input type="file" name="cert_medical" class="form-control @error('cert_medical') is-invalid @enderror"  />
                                            @error('cert_medical')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label @error('photo') is-invalid @enderror">Photo</label>
                                            {{-- la photo doit etre en png ou jpg , jpeg , gif ,   --}}
											<input  type="file" name="photo" class="form-control"
                                            accept=".png, .jpg, .jpeg, .gif" />
                                            @error('photo')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
										</div>
										<div class="mb-3">
											<label class="form-label">Capture du paiement (100 MRU)</label>
											<input type="file" name="capture_paiement" class="form-control @error('capture_paiement') is-invalid @enderror "  />
                                            @error('capture_paiement')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
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

