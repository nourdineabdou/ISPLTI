<x-modal-header-body>
    <x-slot name="title">
        {{ __('Edit User') }}
    </x-slot>
    <div id="editUserForm">
        <form action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <x-forms.input :label="__('Name')" name="name" :value="$user->name"/>
            <x-forms.input :label="__('Email')" name="email" :value="$user->email"/>
            <x-buttons.save
                container="editUserForm"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>
