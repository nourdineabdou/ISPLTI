@props([
    'actions' => [],
    'href' => '#',
    'onclick' => null,
    'label' => null,
    'permission' => null,
    'class' => 'btn btn-info',
])

@php
    $filteredActions = array_filter($actions, function ($action) {
//        dd($action['permission']);
//        dd((is_bool($action['permission']) && $action['permission']) || (\Illuminate\Support\Facades\Gate::allows($action['permission'])));
        return (is_bool($action['permission']) && $action['permission']) || (\Illuminate\Support\Facades\Gate::allows($action['permission']));
    });
@endphp

@if(!empty($filteredActions))
    <div class="btn-group btn-group-sm float-md-right"
         aria-label="Button group with nested dropdown"
         role="group"
    >
        <button
            class="btn btn-info dropdown-toggle dropdown-menu-right box-shadow-2 mb-1"
            id="actionBtnDropdown" type="button"
            data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"
        >
        </button>
        <div class="dropdown-menu" aria-labelledby="actionBtnDropdown">
            @foreach($filteredActions as $action)
                <a onclick="{{ $action['onclick'] ?? null }}"
                   class="dropdown-item"
                   href="{{ $action['href'] ?? '#' }}"
                >
                    {{ $action['label'] ?? '' }}
                </a>
            @endforeach
        </div>
    </div>
@endif

