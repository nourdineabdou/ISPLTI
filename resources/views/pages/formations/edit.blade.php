<x-modal-header-body
    :title="__('formations.edit')"
>
    <div id="edit-formation-form">
        <form
            action="{{ route('formations.update', $formation->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Diplôme"
                    name="degree"
                    required="required"
                    :value="old('degree', $formation->degree)"
                />
                {{-- institution --}}
                <x-forms.input
                    class="col-md-6"
                    label="Institution"
                    name="institution"
                    required="required"
                    :value="old('institution', $formation->institution)"
                />
                {{-- start_year --}}
                <x-forms.input
                    class="col-md-6"
                    label="Année de début"
                    name="start_year"
                    required="required"
                    type="date"
                    :value="old('start_year', $formation->start_year)"
                />
                {{-- end_year --}}
                <x-forms.input
                    class="col-md-6"
                    label="Année de fin"
                    name="end_year"
                    type="date"
                    required="required"
                    :value="old('end_year', $formation->end_year)"
                />
                {{-- description --}}
                <x-forms.input
                    class="col-md-6"
                    label="Description"
                    name="description"
                    required="required"
                    :value="old('description', $formation->description)"
                />

            </div>
            <x-buttons.save
                container="edit-formation-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

