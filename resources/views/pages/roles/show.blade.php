<x-layouts.main
    :title="__('user.role_detail') . ': ' . $role->name"
    :breadcrumbs="[
        [
            'link' => route('roles.index'),
            'label' => __('Roles')
        ],
        [
            'link' => '#',
            'label' => $role->name
        ]
    ]"
    :actions="[
        [
            'label' => __('Edit'),
            'url' => route('roles.edit', $role->id),
            'permission' => 'role-edit',
        ],
        [
            'label' => __('Delete'),
            'onclick' => 'confirmDelete(\'' . route('roles.destroy', $role->id) . '\')',
            'permission' => 'role-delete',
        ],
    ]"
>
    <section class="">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                #ID:
                            </div>
                            <div class="col">
                                {{ $role->id }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                {{ __('user.role_name') }}
                            </div>
                            <div class="col">
                                {{ $role->name }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col">
                                {{ __('user.role_guard_name') }}:
                            </div>
                            <div class="col">
                                @foreach(config('auth.guards') as $guardName => $guard)
                                    {{ $guardName == $role->guard_name ? $role->guard_name : null }}
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <h4 class="mt-2 fw-bolder ">{{__('user.role_permissions')}}: </h4>
                            </div>
                            <div class="col d-flex justify-content-end">
                                @can('role-edit')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">
                                        <i class="la la-pencil"></i>
                                        {{ __('user.role_edit') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <div class="row">
                            @php
                                $getGroupPermission = function ($permission) {
                                    return ucfirst(explode('-', $permission->name)[0]);
                                };
                            @endphp
                            <div class="col">
                                <ul class="list-group list-group-flush">
                                    @foreach($permission->groupBy($getGroupPermission) as $key => $value)
                                        <i class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-12 gy-3">
                                                    <h5 class="fw-bolder">
                                                        <strong>{{ ucfirst($key) }}</strong>
                                                    </h5>
                                                    <div class="row">
                                                        @foreach($value as $item)
                                                            <div class="col-md-3">
                                                                <div class="form-check">
                                                                    @if(in_array($item->name, $role->permissions->pluck('name')->toArray()))
                                                                        <i for="flexCheckDefault-{{ $item->id }}"
                                                                           class="la la-check-circle text-success fw-bolder"></i>
                                                                    @else
                                                                        <i class="la la-times-circle text-danger"></i>
                                                                    @endif
                                                                    <label class="form-check-label"
                                                                           for="flexCheckDefault-{{ $item->id }}">
                                                                        @for($i = 0; $i < count(explode('-', $item->name)) ; $i++)
                                                                            {{ ucfirst(explode('-', $item->name)[$i]) }}
                                                                        @endfor
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </i>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</x-layouts.main>
