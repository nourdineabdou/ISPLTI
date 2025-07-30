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
            <li class="nav-item {{ is_active(route("home_residence")) }}">
                <a href="{{ route('home_residence') }}">
                    <i class="la la-hotel"></i>
                    <span class="menu-title">Dashboard Residence
                    </span></a>
            </li>
            <li class="nav-item {{ is_active(route("home_css")) }}">
                <a href="{{ route('home_css') }}">
                    <i class="la la-building"></i>
                    <span class="menu-title">Dashboard CSS
                    </span></a>
            </li>
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
