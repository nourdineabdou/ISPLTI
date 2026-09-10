@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('assets-lib/img/education/showcase-1.webp') }});">
      <div class="container position-relative">
        <h1>📧 @lang('candidature.verifiez_email_titre')</h1>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    <div style="font-size:4rem;">📨</div>
                    <h2 class="h4 mt-2">@lang('candidature.merci_prenom', ['prenom' => $candidature->prenom])</h2>
                    <p class="text-muted">@lang('candidature.candidature_enregistree', ['numero' => $candidature->numero_candidature])</p>
                    <p>@lang('candidature.email_envoye', ['email' => $candidature->email])</p>
                    <p class="small text-muted mt-3">@lang('candidature.lien_valable_7_jours')</p>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-3 mx-auto" style="width:fit-content;">@lang('candidature.retour_accueil')</a>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
