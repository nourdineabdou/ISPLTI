<x-modal-header-body
    :title="__('etudiants.edit')"
>
    <div id="edit-etudiant-form">
        <form
            action="{{ route('etudiants.update', $etudiant) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-12"
                    label="Name"
                    name="nom"
                    required="required"
                    :value="$etudiant->nom"
                />
                <x-forms.input
                    class="col-md-12"
                    label="Lieu de naissance"
                    name="lieu_naissance"
                    required="required"
                    :value="$etudiant->lieu_naissance"
                />
            </div>
            <x-buttons.save
                container="edit-etudiant-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

