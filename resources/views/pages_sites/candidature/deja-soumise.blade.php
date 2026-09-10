@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>✅ @lang('candidature.deja_soumise_titre')</h1>
      </div>
    </div>
    <section class="posts">
      <div class="container text-center" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    <p>@lang('candidature.deja_soumise_texte', ['numero' => $candidature->numero_candidature, 'date' => optional($candidature->date_soumission)->format('d/m/Y')])</p>
                    <p class="text-muted">@lang('candidature.deja_soumise_note')</p>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary mx-auto mt-2" style="width:fit-content;">@lang('candidature.retour_accueil')</a>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
