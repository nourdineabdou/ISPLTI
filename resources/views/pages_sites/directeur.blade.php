
@extends('layouts_site.main')
@section('content')
<!-- Page Title -->
<div class="page-title dark-background" style="background-image: url({{ asset('assets-lib/img/education/showcase-1.webp') }});">
	<div class="container position-relative">
		<h1>@lang('system.Directrice')</h1>
		<p>@lang('system.Directeur_intro', ['name' => 'Prof. Sofia N.'])</p>
		<nav class="breadcrumbs">
			<ol>
				<li><a href="{{ url('/') }}">@lang('system.Home')</a></li>
				<li class="current">@lang('system.Directrice')</li>
			</ol>
		</nav>
	</div>
</div><!-- End Page Title -->

<section id="director" class="about section">
	<div class="container" data-aos="fade-up">

		<!-- Section title -->
		<div class="container section-title @if(app()->getLocale() == 'ar') text-end @endif" data-aos="fade-up">
			<h2>@lang('system.Meet_Our_Leadership')</h2>
			<p>@lang('system.Directeur_intro', ['name' => 'Prof. Sofia N.'])</p>
		</div>

		<div class="container" data-aos="fade-up" data-aos-delay="100">
			<div class="row mb-5 @if(app()->getLocale() == 'ar') flex-row-reverse text-end @endif">
				<div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
					<h3 class="fw-bold">@lang('system.Directrice') <small class="text-muted">@lang('system.Directeur_title', ['title' => __('system.Directrice') ])</small></h3>
					<p class="lead">@lang('system.Directeur_intro', ['name' => 'Prof. Sofia N.'])</p>

					<div class="d-flex flex-wrap gap-4 mb-4">
						<div class="stat-box">
							<span class="stat-number"><span class="h3">@php echo date('Y') - 2015; @endphp</span></span>
							<span class="stat-label">@lang('system.Années')</span>
						</div>
						<div class="stat-box">
							<span class="stat-number"><span class="h3">@php
								$studentsText = trim(__('system.Institute_Current_Students')); preg_match('/(\d{1,6})/', $studentsText, $mStu); echo $mStu[1] ?? '—';
							@endphp</span></span>
							<span class="stat-label">@lang('system.Étudiants')</span>
						</div>
						<div class="stat-box">
							<span class="stat-number"><span class="h3">@php
								$teachersText = trim(__('system.Institute_Teachers')); preg_match('/(\d{1,6})/', $teachersText, $mTea); echo $mTea[1] ?? '—';
							@endphp</span></span>
							<span class="stat-label">@lang('system.Enseignants')</span>
						</div>
					</div>

					<h6 class="mt-3">@lang('system.Cursus')</h6>
					<ul>
						<li>@lang('system.Cursus_item_1', ['year' => '2010'])</li>
						<li>@lang('system.Cursus_item_2', ['year' => '2014'])</li>
						<li>@lang('system.Cursus_item_3', ['year' => '2018'])</li>
					</ul>

					<h6 class="mt-3">@lang('system.Parcours')</h6>
					<p class="small text-muted">@lang('system.Parcours_desc')</p>

					<div class="mt-4">
						@php $cvPath = public_path('storage/cv_directeur.pdf'); @endphp
						@if(file_exists($cvPath))
							<a href="{{ asset('storage/cv_directeur.pdf') }}" class="btn btn-primary me-2" target="_blank"><i class="bi bi-download"></i> @lang('system.Telecharger_cv')</a>
						@endif
						<a href="mailto:directeur@isplti.sn" class="btn btn-outline-secondary"><i class="bi bi-envelope"></i> @lang('system.Contacter')</a>
					</div>

				</div>

				<div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
					@php
						$photoPath = public_path('storage/directeur.jpg');
						$photoUrl = asset('storage/directeur.jpg');
					@endphp

					@if(file_exists($photoPath))
						<img src="{{ $photoUrl }}" alt="Directrice" class="img-fluid rounded-4 shadow-lg">
					@else
						<div class="placeholder-portrait bg-light rounded-4 d-flex align-items-center justify-content-center" style="height:320px;">
							<h3 class="m-0">@lang('system.Directrice')</h3>
						</div>
					@endif

					<div class="d-flex align-items-center mt-4 signature-block">
						<img src="assets-lib/img/misc/signature-1.webp" alt="Signature" width="120">
						<div class="ms-3">
							<p class="mb-0 fw-bold">Prof. Sofia N.</p>
							<p class="mb-0 text-muted">@lang('system.Directrice')</p>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</section>
@endsection
