
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- <img src="assets-lib/img/logo.webp" alt=""> -->
        
        <h1 class="sitename">ISPLTI</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a  href="{{ route('page') }}" class=" {{ request()->routeIs('page') ? 'active' : '' }}">@lang('system.Accueil')</a></li>
          <li><a class="link-disabled" href="{{ route('pages.about') }}" class="{{ request()->routeIs('pages.about') ? 'active' : '' }}"><span>@lang('system.A_propos')</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
           {{--
            <ul>
              <li><a href="about.html">@lang('system.Notre_Institut')</a></li>
              <li><a href="admissions.html">@lang('system.Admissions')</a></li>
              <li><a href="academics.html">@lang('system.Programmes')</a></li>
              <li><a href="faculty-staff.html">@lang('system.Equipe_pedagogique')</a></li>
              <li><a href="campus-facilities.html">@lang('system.Campus_Installations')</a></li>
            </ul>
            --}}
          </li>

          <li><a class="link-disabled" href="{{ route('pages.viesEstudiantine') }}" class="{{ request()->routeIs('pages.viesEstudiantine') ? 'active' : '' }}">@lang('system.Vie_Etudiante')</a></li>
          <li><a class="link-disabled" href="{{ route('pages.actualite') }}" class="{{ request()->routeIs('pages.actualite') ? 'active' : '' }}">@lang('system.Actualites')</a></li>
          <li><a class="link-disabled" href="{{ route('pages.events') }}" class="{{ request()->routeIs('pages.events') ? 'active' : '' }}">@lang('system.Evenements')</a></li>
          {{--
          <li><a href="alumni.html">Anciens Élèves</a></li>
          --}}
          {{--
          <li class="dropdown"><a href="#"><span>Plus de pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="news-details.html">Détails Actualités</a></li>
              <li><a href="event-details.html">Détails Événements</a></li>
              <li><a href="privacy.html">Confidentialité</a></li>
              <li><a href="terms-of-service.html">Conditions d'utilisation</a></li>
              <li><a href="404.html">Erreur 404</a></li>
              <li><a href="starter-page.html">Page de démarrage</a></li>
            </ul>
          </li>
          --}}
          {{--
          <li class="dropdown"><a href="#"><span>@lang('system.Menu_deroulant')</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">@lang('system.Option_1')</a></li>
              <li class="dropdown"><a href="#"><span>@lang('system.Sous_menu')</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">@lang('system.Sous_menu_1')</a></li>
                  <li><a href="#">@lang('system.Sous_menu_2')</a></li>
                  <li><a href="#">@lang('system.Sous_menu_3')</a></li>
                  <li><a href="#">@lang('system.Sous_menu_4')</a></li>
                  <li><a href="#">@lang('system.Sous_menu_5')</a></li>
                </ul>
              </li>
              <li><a href="#">@lang('system.Option_2')</a></li>
              <li><a href="#">@lang('system.Option_3')</a></li>
              <li><a href="#">@lang('system.Option_4')</a></li>
            </ul>
          </li>
          --}}
          <li><a class="link-disabled" href="{{ route('pages.contact') }}">@lang('system.Contact')</a></li>
          {{-- li connexion ou deconnexion
        <li class="dropdown"><a href="#"><span>@lang('system.Connexion')</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a href="{{ route('login') }}">@lang('system.Se_connecter')</a></li>
                <li><a href="{{ route('inscriptions.login1') }}">@lang('system.S_inscrire')</a></li>
                <li><a href="{{ route('inscriptions.login2') }}">@lang('system.rescription')</a></li>
            </ul>
        </li>
        --}}
            <li class="dropdown"><a disabled href="#"><span>@lang('system.Langue')</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <li><a href="{{ route('language.switch', ['locale' => 'fr']) }}">@lang('system.fr')</a></li>
                    <li><a href="{{ route('language.switch', ['locale' => 'en']) }}">@lang('system.en')</a></li>
                    <li><a href="{{ route('language.switch', ['locale' => 'ar']) }}">@lang('system.ar')</a></li>
                </ul>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>

      </nav>
    </div>
</header>
