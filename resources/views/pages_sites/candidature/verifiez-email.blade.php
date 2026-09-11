@extends('layouts_site.main')
@section('content')
    <div class="page-title dark-background" style="background-image: url( {{ asset('isptli_apparences.png') }});">
      <div class="container position-relative">
        <h1>📧 @lang('candidature.verifiez_email_titre')</h1>
      </div>
    </div>

    <section class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <div class="card shadow-sm border-0 rounded-4 p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-warning">{{ session('error') }}</div>
                    @endif
                    <div style="font-size:4rem;">📨</div>
                    <h2 class="h4 mt-2">@lang('candidature.merci_prenom', ['prenom' => $candidature->prenom])</h2>
                    <p class="text-muted">@lang('candidature.candidature_enregistree', ['numero' => $candidature->numero_candidature])</p>
                    <p>@lang('candidature.email_envoye', ['email' => $candidature->email])</p>
                    <p class="small text-muted mt-3">@lang('candidature.lien_valable_7_jours')</p>
                    <div class="d-flex flex-wrap justify-content-center gap-2 mt-3">
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary" style="width:fit-content;">@lang('candidature.retour_accueil')</a>
                        <form action="{{ route('candidature.renvoyer', $candidature->token) }}" method="POST" style="width:fit-content;">
                            @csrf
                            <button type="submit" class="btn btn-outline-success" data-loading-text="@lang('candidature.traitement_en_cours')">
                                📤 @lang('candidature.renvoyer_email')
                            </button>
                        </form>
                    </div>
                    <p class="small text-muted mt-3">@lang('candidature.pas_recu_email')</p>
                </div>
            </div>
        </div>
      </div>
    </section>
@endsection
