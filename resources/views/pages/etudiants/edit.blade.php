<x-modal-header-body
    :title="'Motif de rejet de l\'étudiant ' . $etudiant->nom_fr"
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
                    label="Motif de rejet"
                    name="motif_rejet"
                    required="required"
                    :value="$etudiant->motif_rejet"
                />
            </div>
            <x-buttons.save
                container="edit-etudiant-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

