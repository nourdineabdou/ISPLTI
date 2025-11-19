<x-modal-header-body
    :title="__('cours.edit')"
>
    <div id="edit-cours-form">
        <form
            action="{{ route('mescours.update', $cours->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <x-forms.select
                    class="col-md-6"
                    label="matiére"
                    name="matiere_id"
                    required="required"
                    :value="$cours->matiere_id"
                    :options="$matieres"
                    labelField="lib_element_fr"
                />
                {{-- specialite --}}
                <x-forms.select
                    class="col-md-6"
                    label="Spécialité"
                    name="specialite_id"
                    required="required"
                    :value="$cours->specialite_id"
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
                container="edit-cours-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

