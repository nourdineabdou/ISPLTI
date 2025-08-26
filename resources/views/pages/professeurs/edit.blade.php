<x-modal-header-body
    :title="__('professeurs.edit')"
>
    <div id="edit-professeur-form">
        <form
            action="{{ route('professeurs.update', $professeur) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-12"
                    label="Nom"
                    name="nom"
                    required="required"
                    :value="$professeur->nom"
                />
                <x-forms.input
                    class="col-md-12"
                    label="Téléphone"
                    name="telephone"
                    required="required"
                    :value="$professeur->telephone"
                />
                <x-forms.input
                    class="col-md-12"
                    label="Spécialité"
                    name="specialite"
                    required="required"
                    :value="$professeur->specialite"
                />
            </div>
            <x-buttons.save
                container="edit-professeur-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

