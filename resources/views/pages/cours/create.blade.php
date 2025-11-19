<x-modal-header-body
    :title="__('cours.create')"
>
    <div id="create-professeur-form">
        <form
            action="{{ route('mescours.store') }}"
            method="POST"
            id="create-cours-form"
            class="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="row">
                <x-forms.select
                    class="col-md-6"
                    label="matiére"
                    name="matiere_id"
                    required="required"
                    value="{{ old('matiere_id') }}"
                    :options="$matieres"
                    labelField="lib_element_fr"
                />
                {{-- specialite --}}
                <x-forms.select
                    class="col-md-6"
                    label="Spécialité"
                    name="specialite_id"
                    required="required"
                    value="{{ old('specialite_id') }}"
                    :options="$specialites"
                    labelField="lib_annee_diplome_fr"
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
