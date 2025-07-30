<x-modal-header-body
    title="{{ __('user.create_user') }}"
>

    <div id="createUserForm">
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <x-forms.input label="Name" name="name" required="required"/>
            <x-forms.input label="Email" name="email" type="email" required="required"/>
            <x-buttons.save
                container="createUserForm"
                value="{{ __('Create User') }}"
                onclick="saveForm({ element: this})"
            />
        </form>
    </div>
</x-modal-header-body>
