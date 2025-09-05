<x-modal-header-body
    :title="__('etudiants.create')"
>
    <div id="create-etudiant-form">
        <form
            action="{{ route('etudiants.store') }}"
            method="POST"
            id="create-etudiant-form"
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
                <x-forms.input
                    class="col-md-12"
                    label="Lieu de naissance"
                    name="lieu_naissance"
                    required="required"
                    value="{{ old('lieu_naissance') }}"
                />

            </div>
            <x-buttons.save
                container="create-etudiant-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
