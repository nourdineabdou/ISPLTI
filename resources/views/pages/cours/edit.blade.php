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
              <x-forms.input
                    class="col-md-6"
                    label="matiére"
                    name="matiere_id"
                    required="required"
                    :value="{{ old('matiere_id', $cours->matiere_id) }}"
                />
                {{-- specialite --}}
                <x-forms.input
                    class="col-md-6"
                    label="Spécialité"
                    name="specialite_id"
                    required="required"
                    :value="{{ old('specialite_id', $cours->specialite_id) }}"
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

