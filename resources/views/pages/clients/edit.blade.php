<x-modal-header-body
    :title="__('clients.edit')"
>
    <div id="edit-client-form">
        <form
            action="{{ route('clients.update', $client) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Nom"
                    name="nom"
                    required
                    :value="$client->nom"
                />
                <x-forms.select
                    class="col-md-6"
                    label="{{ __('clients.type') }}"
                    name="type_client"
                    placeholder="{{ __('clients.type') }}"
                    data-placeholder="{{ __('clients.type') }}"
                    :options="$types"
                    :value="$client->type_client"
                    required
                />
                <x-forms.input
                    class="col-md-6"
                    label="{{ __('clients.phone') }}"
                    name="phone"
                    required
                    :value="$client->phone"
                />
                <x-forms.input
                    class="col-md-6"
                    label="{{ __('clients.email') }}"
                    name="email"
                    required="required"
                    :value="$client->email"
                />
                <x-forms.input
                    class="col-md-12"
                    label="{{ __('clients.adresse') }}"
                    name="adresse"
                    required
                    :value="$client->adresse"
                />
            </div>
            <x-buttons.save
                container="edit-client-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

