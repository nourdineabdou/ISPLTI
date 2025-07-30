<li class="{{ is_active(route('caisses.index')) }}">
    <a class="menu-item" href="{{ route('caisses.index') }}">
        <i class="la la-money"></i>
        <span>
            Caisse
        </span>
    </a>
</li>
{{-- liste des horaires --}}
<li class="{{ is_active(route('caisses.horaire')) }}">
    <a class="menu-item" href="{{ route('caisses.horaire') }}">
        <i class="la la-clock-o"></i>
        <span>
            {{ __('Horaires') }}
        </span>
    </a>
</li>
@can('client-list')
    <li class="{{ is_active(route('clients.index')) }}">
        <a class="menu-item" href="{{ route('clients.index') }}">
            <i class="la la-users"></i>
            <span>{{ __('client.clients') }}</span>
        </a>
    </li>
@endcan
@can('provider-list')
    <li class="{{ is_active(route('fournisseurs.index')) }}">
        <a class="menu-item" href="{{ route('fournisseurs.index') }}">
            <i class="la la-users"></i>
            <span>{{ __('client.providers') }}</span>
        </a>
    </li>
@endcan
@can('employee-list')
    <li class="{{ is_active(route('employees.index')) }}">
        <a class="menu-item" href="{{ route('employees.index') }}">
            <i class="la la-users"></i>
            <span>{{ __('client.employees') }}</span>
        </a>
    </li>
@endcan

