@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('isptli_apparences.png') }});">
      <div class="container position-relative">
        <h1>🎉 @lang('candidature.confirmation_titre')</h1>
      </div>
    </div>
    <section class="posts">
      <div class="container text-center" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    <div style="font-size:4rem;">✅</div>
                    <h2 class="h4 mt-2">@lang('candidature.merci_nom_prenom', ['prenom' => $candidature->prenom, 'nom' => $candidature->nom])</h2>
                    <p>@lang('candidature.candidature_envoyee_texte', ['master' => $candidature->master->intituleLocalise()])</p>
                    <div class="badge rounded-pill px-3 py-2 fs-6" style="background:#08915e;">{{ $candidature->numero_candidature }}</div>
                    <p class="text-muted mt-4 small">@lang('candidature.conserver_numero')</p>
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary mx-auto mt-2" style="width:fit-content;">@lang('candidature.retour_accueil')</a>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
