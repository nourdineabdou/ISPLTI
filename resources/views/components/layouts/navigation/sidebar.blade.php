@php
    $page_active = \Illuminate\Support\Facades\Route::currentRouteName();
@endphp
{{--@php
    $page_active = Route::currentRouteName();
@endphp
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ url('/') }}">
                <i class="bi bi-grid"></i>
                <span>{{__("Dashboard")}}</span>
            </a>
        </li>
        @foreach (glob(resource_path('views/*/_menu.blade.php')) as $menu)
            @include(str_replace(
                [resource_path('views/'), '.blade.php'],
                ['', ''],
                $menu
            ),
            ['page_active' => $page_active])
        @endforeach
        @foreach (glob(resource_path('views/pages/*/_menu.blade.php')) as $menu)
            @include(str_replace(
                [resource_path('views/'), '.blade.php'],
                ['', ''],
                $menu
            ),
            ['page_active' => $page_active])
        @endforeach
    </ul>

</aside><!-- End Sidebar-->--}}

<!-- BEGIN: Main Menu-->

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ is_active(route("home")) }}">
                <a href="{{ route('home') }}">
                    <i class="la la-home"></i>
                    <span class="menu-title">Dashboard
                    </span></a>
            </li>
            @if(auth()->user()->hasRole('Admin'))
               {{-- gestion des cours --}}
                <li class="nav-item ">
                    <a href="{{ route('mescours.index') }}">
                        <i class="la la-book"></i>
                        <span class="menu-title">Gestion des Cours</span>
                    </a>
                </li>
                {{-- ajouter un etudiant --}}
                <li class="nav-item ">
                    <a href="{{ route('etudiants.index') }}">
                        <i class="la la-user-graduate"></i>
                        <span class="menu-title">Gestion des Étudiants</span>
                    </a>
                </li>
                {{-- ajouter bachelier --}}
                <li class="nav-item ">
                    <a href="{{ route('bacheliers.index') }}">
                        <i class="la la-chalkboard-teacher"></i>
                        <span class="menu-title">Gestion des Bacheliers</span>
                    </a>
                </li>
                {{-- ajouter un professeur --}}
                <li class="nav-item ">
                    <a href="{{ route('professeurs.index') }}">
                        <i class="la la-chalkboard-teacher"></i>
                        <span class="menu-title">Gestion des Professeurs</span>
                    </a>
                </li>
                {{-- ajouter un cours --}}
                <li class="nav-item ">
                    <a href="#">
                        <i class="la la-book"></i>
                        <span class="menu-title">Gestion des Emplois</span>
                    </a>
                </li>


                {{-- emplois du temps / par specialite --}}
                <li class="nav-item ">
                    <a href="{{ route('etudiants.emplois') }}">
                        <i class="la la-clock"></i>
                        <span class="menu-title"> Emplois du temps/Spécialités</span>
                    </a>
                </li>
                {{-- emplois du temps de professeur --}}
                <li class="nav-item ">
                    <a href="{{ route('professeurs.emploi_du_temps') }}">
                        <i class="la la-clock"></i>
                        <span class="menu-title"> Emplois du temps/Professeurs</span>
                    </a>
                </li>

                {{-- ajouter un parametre --}}
                <li class="nav-item ">
                    <a href="#">
                        <i class="la la-cog"></i>
                        <span class="menu-title">Paramètres</span>
                    </a>
                </li>
                {{-- ajouter une actualité --}}
                <li class="nav-item ">
                    <a href="{{ route('actualites.index') }}">
                        <i class="la la-newspaper"></i>
                        <span class="menu-title">Actualités</span>
                    </a>
                </li>
                {{-- candidatures master --}}
                <li class="nav-item ">
                    <a href="{{ route('candidatures.index') }}">
                        <i class="la la-file-signature"></i>
                        <span class="menu-title">Candidatures</span>
                    </a>
                </li>
                @elseif(auth()->user()->hasRole('Professeur'))
                {{-- recupere profosseur --}}
                @php
                  $professeur = \App\Models\Professeur::where('user_id', auth()->user()->id)->first();
                @endphp
                {{-- profill  --}}
                <li class="nav-item ">
                    <a href="{{ route('professeurs.profil', $professeur->id) }}">
                        <i class="la la-user"></i>
                        <span class="menu-title">Mon Profil</span>
                    </a>
                </li>
                {{-- mes experiences --}}
                <li class="nav-item ">
                    <a href="{{ route('experiences.index') }}">
                        <i class="la la-briefcase"></i>
                        <span class="menu-title">Mes Expériences</span>
                    </a>
                </li>
                {{-- mes formations --}}

                <li class="nav-item ">
                    <a href="{{ route('formations.index') }}">
                        <i class="la la-graduation-cap"></i>
                        <span class="menu-title">Mes Formations</span>
                    </a>
                </li>
                {{-- langues --}}
                <li class="nav-item">
                    <a href="{{ route('languages.index') }}">
                        <i class="la la-language"></i>
                        <span class="menu-title">Mes Langues</span>
                    </a>
                </li>
                {{-- cours --}}
                <li class="nav-item">
                    <a href="{{ route('mescours.index') }}">
                        <i class="la la-book"></i>
                        <span class="menu-title">Mes Cours</span>
                    </a>
                </li>
                @elseif(auth()->user()->hasRole('Etudiant'))
                {{-- recupere etudiant --}}
                @php
                  $etudiant = \App\Models\Etudiant::where('user_id', auth()->user()->id)->first();
                @endphp
              {{-- profill --}}
                <li class="nav-item ">
                    <a href="{{ route('etudiants.profil', $etudiant->id) }}">
                        <i class="la la-user"></i>
                        <span class="menu-title">Mon Profil</span>
                    </a>
                </li>
                {{-- attestation --}}
                <li class="nav-item ">
                    <a href="#">
                        <i class="la la-file-alt"></i>
                        <span class="menu-title">Attestation</span>
                    </a>
                </li>
                {{-- les  cours  --}}
                <li class="nav-item ">
                    <a href="{{ route('mescours.index', $etudiant->id) }}">
                        <i class="la la-book"></i>
                        <span class="menu-title">Mes Cours</span>
                    </a>
                </li>
                {{-- mes documents --}}
                <li class="nav-item ">
                    <a href="#">
                        <i class="la la-file"></i>
                        <span class="menu-title">Mes Documents</span>
                    </a>
                </li>

            @endif
            {{--<li class=" nav-item"><a href="#"><i class="la la-television"></i>
                    <span class="menu-title">Templates</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#"><i></i><span data-i18n="Vertical">Vertical</span></a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="../vertical-menu-template"><i></i><span
                                        data-i18n="Classic Menu">Classic Menu</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="menu-item" href="dashboard-ecommerce.html"><i></i><span data-i18n="eCommerce">eCommerce</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item"><a href="https://pixinvent.ticksy.com/" target="_blank"><i
                        class="la la-support"></i><span class="menu-title"
                                                        data-i18n="Raise Support">Raise Support</span></a>
            </li>
            <li class=" nav-item"><a
                    href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation"
                    target="_blank"><i class="la la-text-height"></i><span class="menu-title" data-i18n="Documentation">Documentation</span></a>
            </li>--}}

            @foreach (glob(resource_path('views/pages/*/_menu.blade.php')) as $menu)
                @include(str_replace(
                    [resource_path('views/'), '.blade.php'],
                    ['', ''],
                    $menu
                ),
                ['page_active' => $page_active])
            @endforeach
        </ul>
    </div>
</div>
