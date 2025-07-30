<x-modal-header-body>
    <x-slot name="title">
        {{ __('Edit invitation') }}
    </x-slot>

    <div id="editInvitationForm">
        <form action="{{ route('invitation.update', ['id' => $invitation->id]) }}" method="post">
            @csrf
            @method('PUT')
            <x-forms.input
                value="{{ $invitation->email }}"
                label="Email" name="email" type="email" required="required"/>
            <x-buttons.save
                container="editInvitationForm"
                value="{{ __('Send invitation') }}"
                onclick="saveForm({ element: this})"
            />
        </form>
    </div>
</x-modal-header-body>
