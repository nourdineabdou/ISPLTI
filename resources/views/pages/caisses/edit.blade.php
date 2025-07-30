<x-modal-header-body
    :title="__('caisses.edit')"
>
    <div id="edit-caisse-form">
        <form
            action="{{ route('caisses.update', $caisse) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-12"
                    label="Name"
                    name="nom"
                    required="required"
                    :value="$caisse->nom"
                />
                <x-forms.select
                    class="col-md-12"
                    label="Type"
                    name="type"
                    :options="App\Models\Caisse::getTypeOptions()"
                    required="required"
                    :value="$caisse->type"
                />
            </div>
            <x-buttons.save
                container="edit-caisse-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

