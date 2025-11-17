<x-modal-header-body
    :title="__('cours.create')"
>
    <div id="create-cours-form">
        <form
            action="{{ route('mescours.store') }}"
            method="POST"
            id="create-cours-form"
            class="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="matiére"
                    name="matiere_id"
                    required="required"
                    value="{{ old('matiere_id') }}"
                />
                {{-- specialite --}}
                <x-forms.input
                    class="col-md-6"
                    label="Spécialité"
                    name="specialite_id"
                    required="required"
                    value="{{ old('specialite_id') }}"
                />

                {{-- cours PDF --}}
                <x-forms.input
                    class="col-md-6"
                    label="Cours PDF"
                    name="chemain_pde"
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
