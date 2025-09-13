<x-modal-header-body
    :title="__('professeurs.create')"
>
    <div id="create-professeur-form">
        <form
            action="{{ route('professeurs.store') }}"
            method="POST"
            id="create-professeur-form"
            class="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Nom"
                    name="nom"
                    required="required"
                    value="{{ old('name') }}"
                />
                {{-- prenom --}}
                <x-forms.input
                    class="col-md-6"
                    label="Prénom"
                    name="prenom"
                    required="required"
                    value="{{ old('prenom') }}"
                />
                {{-- telephone --}}
                <x-forms.input
                    class="col-md-6"
                    label="Téléphone"
                    name="telephone"
                    required="required"
                    value="{{ old('telephone') }}"
                />
                {{-- email --}}
                <x-forms.input
                    class="col-md-6"
                    label="Email"
                    name="email"
                    type="email"
                    required="required"
                    value="{{ old('email') }}"
                />
                {{-- specialite --}}
                <x-forms.input
                    class="col-md-6"
                    label="Spécialité"
                    name="specialite"
                    required="required"
                    value="{{ old('specialite') }}"
                />
                {{-- nni --}}
                <x-forms.input
                    class="col-md-6"
                    label="NNI"
                    name="nni"
                    required="required"
                    value="{{ old('nni') }}"
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
                container="create-professeur-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
