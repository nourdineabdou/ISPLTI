@extends('layouts_site.main')
@section('content')
    @php
        $locale = app()->getLocale();
        $titre = $locale == 'fr' ? $actualite->titre_fr : ($locale == 'en' ? $actualite->titre_en : $actualite->titre_ar);
        $contenu = $locale == 'fr' ? $actualite->contenu_fr : ($locale == 'en' ? $actualite->contenu_en : $actualite->contenu_ar);
        $isRtl = $locale == 'ar';
    @endphp
    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url( {{ asset($actualite->image) }});">
      <div class="container position-relative">
        <h1>{{ $titre }}</h1>
        <p>{{ $actualite->auteur }} — {{ \Carbon\Carbon::parse($actualite->created_at)->locale($locale)->isoFormat('LL') }}</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="{{ url('/') }}">@lang('system.Home')</a></li>
            <li><a href="{{ route('pages.actualite') }}">@lang('system.News_Title')</a></li>
            <li class="current">{{ $titre }}</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <section id="actualite-details" class="posts">
      <div class="container" data-aos="fade-up">
        <article class="@if($isRtl) text-end @endif" @if($isRtl) dir="rtl" @endif>

            {{-- contenu riche (texte + emoji) --}}
            <div class="actualite-content mb-5">
                {!! $contenu !!}
            </div>

            {{-- photos + videos : grille adaptative type Facebook --}}
            @php
                $mediaDetails = $actualite->images->map(fn($i) => ['type' => 'image', 'url' => asset($i->chemin)])
                    ->concat($actualite->videos->map(fn($v) => ['type' => 'video', 'url' => asset($v->chemin)]));
            @endphp
            @if($mediaDetails->count())
                <x-actualite.media-grid :media="$mediaDetails" :galleryKey="'actualite-' . $actualite->id" :max="6" />
            @endif

            {{-- fichiers telechargeables --}}
            @if($actualite->fichiers->count())
                <h3 class="h4 mb-3">📎 @lang('system.Fichiers')</h3>
                <div class="row g-3 mb-5">
                    @foreach($actualite->fichiers as $fichier)
                        <div class="col-md-6">
                            <a href="{{ asset($fichier->chemin) }}" target="_blank" class="download-card text-decoration-none shadow-sm rounded-3 d-flex align-items-center p-3 h-100">
                                <div class="icon me-3"><i class="bi {{ $fichier->iconClass() }}" style="font-size:2rem;"></i></div>
                                <div>
                                    <div class="fw-bold">{{ $fichier->nom($locale) }}</div>
                                    @if($fichier->description($locale))
                                        <div class="small text-muted">{{ $fichier->description($locale) }}</div>
                                    @endif
                                    <div class="small text-muted">{{ $fichier->tailleLisible() }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            <a href="{{ route('pages.actualite') }}" class="btn btn-outline-primary mt-3">@lang('system.Retour')</a>
        </article>
      </div>
    </section>
@endsection
