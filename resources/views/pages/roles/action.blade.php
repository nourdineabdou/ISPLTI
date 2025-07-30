@php
    $actions = [
        [
            'label' => __('Voir'),
             'href' => route('roles.show', $role->id),
            'permission' => 'role-show',
        ],
        [
            'label' => __('Modifier'),
            'href' => route('roles.edit', $role->id),
            'permission' => 'role-edit',
        ],
        [
            'label' => __('Supprimer'),
            'onclick' => 'confirmDelete(\'' . route('roles.destroy', $role->id) . '\')',
            'permission' => 'role-delete',
        ],
]
@endphp

<x-buttons.action
    :actions="$actions"
/>
