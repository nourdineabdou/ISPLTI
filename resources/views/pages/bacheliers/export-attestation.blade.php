<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Attestation d'inscription</title>
	<style>
		/* PDF-friendly styles for dompdf with repeated header/footer and page numbers */
		@page { margin:40mm 24mm 36mm 24mm; }
		body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; color: #0f172a; }
		.pdf-header { position: fixed; top: 0; left: 0; right: 0; height: 40mm; padding:8px 24mm; }
		.pdf-footer { position: fixed; bottom: 0; left: 0; right: 0; height: 36mm; padding:8px 24mm; font-size:11px; color:#475569; }
		.page { width:210mm; min-height:297mm; margin:0; padding:0; box-sizing:border-box; }
		.content { border:1px solid #e6e9ef; padding:18px; border-radius:8px; margin-top:8px; }
		.logo { width:100px; height:100px; object-fit:contain; }
		.title { text-align:center; margin-top:8px; }
		h1 { font-size:22px; margin:0; letter-spacing:1px; }
		h2 { font-size:18px; margin:6px 0 12px 0; }
		.center { text-align:center; }
		.muted { color:#6b7280; }
		.field { margin:8px 0; }
		.field strong { display:inline-block; width:160px; }
		.stamp { margin-top:28px; display:flex; justify-content:space-between; align-items:center; page-break-inside:avoid; }
		.seal { border-radius:6px; padding:12px 18px; border:2px solid #0f172a; font-weight:700; }
		.pagenum:before { content: counter(page); }
		.page-break { page-break-after: always; }
		.avoid-break { page-break-inside: avoid; }
	</style>
</head>
<body>
@php
	// Resolve logo path: use asset() when opened in browser (?web=1), otherwise public_path for dompdf
	$logoUrl = null;
	if(isset($bachelier->etablissement_logo) && $bachelier->etablissement_logo) {
		if(request()->has('web')) {
			$logoUrl = asset('storage/' . $bachelier->etablissement_logo);
		} else {
			$logoUrl = public_path('storage/' . $bachelier->etablissement_logo);
		}
	}
@endphp

<div class="pdf-header">
	<div style="display:flex;align-items:center;justify-content:space-between;">
		<div>
			@if($logoUrl)
				<img src="{{ $logoUrl }}" alt="logo" class="logo">
			@else
				<div style="width:100px;height:100px;background:#eef2ff;display:flex;align-items:center;justify-content:center;border-radius:8px;font-weight:700;color:#1e293b;">LOGO</div>
			@endif
		</div>

		<div class="title">
			<h1>INSTITUT SUPERIEUR</h1>
			<h2>Attestation d'inscription</h2>
			<div class="muted">Référence : {{ $bachelier->nodos ?? ($bachelier->id ?? '-') }}</div>
		</div>

		<div style="width:100px; text-align:right;">
			<small class="muted">Date: {{ date('d/m/Y') }}</small>
		</div>
	</div>
</div>

<div class="pdf-footer">
	<div style="display:flex;justify-content:space-between;align-items:center;">
		<div>Institut - Adresse complète - Téléphone</div>
		<div>www.example.edu</div>
		<div>Page <span class="pagenum"></span></div>
	</div>
</div>

<div class="page">
	<div class="content">
		<p class="center" style="font-size:15px; margin-bottom:18px;">Par la présente, nous attestons que :</p>

		<div style="max-width:620px;margin:0 auto;">
			<p class="field"><strong>Nom (FR) :</strong> {{ $bachelier->nom_fr ?? '-' }}</p>
			<p class="field"><strong>Nom (AR) :</strong> {{ $bachelier->nom_ar ?? '-' }}</p>
			<p class="field"><strong>Date de naissance :</strong> {{ $bachelier->date_naissance ? date('d/m/Y', strtotime($bachelier->date_naissance)) : '-' }}</p>
			<p class="field"><strong>Lieu de naissance :</strong> {{ $bachelier->lieu_naissance_fr ?? $bachelier->lieu_naissance ?? '-' }}</p>
			<p class="field"><strong>Nationalité :</strong> {{ $bachelier->nationalite ?? '-' }}</p>
			<p class="field"><strong>Numéro BAC :</strong> {{ $bachelier->num_bac ?? '-' }}</p>
			<p class="field"><strong>Année d'entrée :</strong> {{ $bachelier->annee_entree_etabliss ?? '-' }}</p>
			<p class="field"><strong>Adresse :</strong> {{ $bachelier->adresse ?? '-' }}</p>
			<p class="field"><strong>Email :</strong> {{ $bachelier->email ?? '-' }}</p>
		</div>

		<p style="margin-top:18px;">Cet étudiant est inscrit au sein de notre établissement pour l'année universitaire en cours. La présente attestation est délivrée pour servir et valoir ce que de droit.</p>

		<div class="stamp">
			<div class="muted">
				<div><strong>Numéro d'inscription :</strong> {{ $bachelier->nodos ?? ($bachelier->id ?? '-') }}</div>
				<div><strong>Statut :</strong> {{ isset($bachelier->insriptions) ? ($bachelier->insriptions == 2 ? 'Validée' : 'En cours') : 'N/A' }}</div>
			</div>

			<div style="text-align:right">
				<div class="seal">Cachet officiel</div>
				<div style="font-size:12px;margin-top:6px;">Signature du directeur</div>
			</div>
		</div>
	</div>

	</div>
</div>
</body>
</html>

@if(request()->has('print'))
	<script>
		// auto print when opened in browser with ?print=1
		window.addEventListener('load', function(){ setTimeout(function(){ window.print(); }, 200); });
	</script>
@endif
