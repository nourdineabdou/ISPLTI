@hasAnyPermission('user-list|role-list')
<li class=" nav-item">
    <a href="#">
        <i class="la la-users"></i>
        <span class="menu-title">
            {{ __('user.management') }}
        </span></a>
    <ul class="menu-content">
        @can('user-list')
            <li class="{{ is_active(route('users.index')) }}">
                <a class="menu-item" href="{{ route('users.index') }}"><i></i>
                    <span>{{ __('user.list') }}</span>
                </a>
            </li>
        @endcan
        @can('role-list')
            <li class="{{ is_active(route('roles.index')) }}">
                <a class="menu-item" href="{{ route('roles.index') }}"><i></i>
                    <span>{{ __('user.roles') }}</span>
                </a>
            </li>
        @endcan
    </ul>
</li>
@endhasAnyPermission

