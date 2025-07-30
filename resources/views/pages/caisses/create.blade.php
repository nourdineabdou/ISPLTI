<x-modal-header-body
    :title="__('caisses.create')"
>
    <div id="create-caisse-form">
        <form
            action="{{ route('caisses.store') }}"
            method="POST"
            id="create-caisse-form"
            class="form"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-12"
                    label="Nom"
                    name="nom"
                    required="required"
                    value="{{ old('name') }}"
                />
                {{-- type --}}
                <x-forms.select
                    class="col-md-12"
                    label="Type"
                    name="type"
                    {{-- recuperer le type a partir de la classe Caisse --}}
                    :options="App\Models\Caisse::getTypes()"
                    required="required"
                    value="{{ old('type') }}"
                />

            </div>
            <x-buttons.save
                container="create-caisse-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
