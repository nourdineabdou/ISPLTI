<x-modal-header-body
    :title="__('professeurs.create')"
>
    <div id="create-professeur-form">
        <form
            action="{{ route('professeurs.store') }}"
            method="POST"
            id="create-professeur-form"
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
                {{-- telephone --}}
                <x-forms.input
                    class="col-md-12"
                    label="Téléphone"
                    name="telephone"
                    required="required"
                    value="{{ old('telephone') }}"
                />
                {{-- specialite --}}
                <x-forms.input
                    class="col-md-12"
                    label="Spécialité"
                    name="specialite"
                    required="required"
                    value="{{ old('specialite') }}"
                />
            </div>
            <x-buttons.save
                container="create-professeur-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
