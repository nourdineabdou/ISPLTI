<x-modal-header-body
    :title="__('clients.create')"
>
    <div id="create-client-form">
        <form
            action="{{ route('clients.store') }}"
            method="POST"
            id="create-client-form"
            class="form"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Nom"
                    name="nom"
                    required="required"
                    value="{{ old('nom') }}"
                />
                <x-forms.select
                    class="col-md-6"
                    label="{{ __('clients.type') }}"
                    name="type_client"
                    placeholder="{{ __('clients.type') }}"
                    data-placeholder="{{ __('clients.type') }}"
                    :options="$types"
                    required
                />
                <x-forms.input
                    class="col-md-6"
                    label="{{ __('clients.phone') }}"
                    name="phone"
                    required="required"
                    value="{{ old('phone') }}"
                />
                <x-forms.input
                    class="col-md-6"
                    label="{{ __('clients.email') }}"
                    name="email"
                    required="required"
                    value="{{ old('email') }}"
                />
                <x-forms.input
                    class="col-md-12"
                    label="{{ __('clients.adresse') }}"
                    name="adresse"
                    required="required"
                    value="{{ old('adresse') }}"
                />
            </div>
            <x-buttons.save
                container="create-client-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
