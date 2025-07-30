@hasAnyPermission('stock-list|commande-list')
<li class=" nav-item">
    <a href="#">
        <i class="la la-italic"></i>
        <span class="menu-title">
            {{ __('stock.stock_management') }}
        </span></a>
    <ul class="menu-content">
        @can('user-list')
            <li class="{{ is_active(route('stocks.index')) }}">
                <a class="menu-item" href="{{ route('stocks.index') }}"><i></i>
                    <span>{{ __('stock.stocks') }}</span>
                </a>
            </li>
        @endcan
        @can('role-list')
            <li class="{{ is_active(route('commendes.index')) }}">
                <a class="menu-item" href="{{ route('commendes.index') }}"><i></i>
                    <span>Commandes</span>
                </a>
            </li>
        @endcan
        @can('role-list')
        <li class="{{ is_active(route('sorti.index')) }}">
            <a class="menu-item" href="{{route('sorti.index')}}"><i></i>
                <span>Commande cuisine</span>
            </a>
        </li>
        @endcan
        @can('role-list')
        <li class="{{ is_active(route('stocks.systeme')) }}">
            <a class="menu-item" href="{{route('stocks.systeme')}}"><i></i>
                <span>Consomation stock cuisine </span>
            </a>
        </li>
        @endcan
        <li>
            <a class="menu-item" href="{{ route('dechets.index') }}"><i></i>
                <span>{{ __('déchets organiques') }}</span>
            </a>
        </li>
    </ul>
</li>
@endhasAnyPermission
