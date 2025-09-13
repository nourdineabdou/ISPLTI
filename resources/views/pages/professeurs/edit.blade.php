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
                    class="col-md-6"
                    label="Nom"
                    name="nom"
                    required="required"
                    :value="$professeur->nom"
                />
                {{-- prenom --}}
                <x-forms.input
                    class="col-md-6"
                    label="Prénom"
                    name="prenom"
                    required="required"
                    :value="$professeur->prenom"
                />
                <x-forms.input
                    class="col-md-6"
                    label="Téléphone"
                    name="telephone"
                    required="required"
                    :value="$professeur->telephone"
                />
                {{-- email --}}
                <x-forms.input
                    class="col-md-6"
                    label="Email"
                    name="email"
                    type="email"
                    required="required"
                    :value="$professeur->email"
                />
                <x-forms.input
                    class="col-md-6"
                    label="Spécialité"
                    name="specialite"
                    required="required"
                    :value="$professeur->specialite"
                />
                {{-- nni --}}
                <x-forms.input
                    class="col-md-6"
                    label="NNI"
                    name="nni"
                    required="required"
                    :value="$professeur->nni"
                />
                {{-- cv --}}
                <x-forms.input
                    class="col-md-6"
                    label="CV"
                    name="cv"
                    type="file"
                />
                {{-- image --}}
                <x-forms.input
                    class="col-md-6"
                    label="Image"
                    name="image"
                    type="file"
                />
            </div>
            <x-buttons.save
                container="edit-professeur-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

