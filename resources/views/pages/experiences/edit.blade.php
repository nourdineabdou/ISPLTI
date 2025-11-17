<x-modal-header-body
    :title="__('experiences.edit')"
>
    <div id="edit-experience-form">
        <form
            action="{{ route('experiences.update', $experience->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Intitulé du poste"
                    name="job_title"
                    required="required"
                    :value="$experience->job_title"
                />

                {{-- institution --}}

                <x-forms.input
                    class="col-md-6"
                    label="Institution"
                    name="institution"
                    required="required"
                    :value="old('institution', $experience->institution)"
                />
                {{-- start_date --}}
                <x-forms.input
                    class="col-md-6"
                    label="Date de début"
                    name="start_date"
                    type="date"
                    required="required"
                    :value="old('start_date', $experience->start_date)"
                />
                 {{-- end_date --}}
                <x-forms.input
                    class="col-md-6"
                    label="Date de fin"
                    name="end_date"
                    type="date"
                    required="required"
                    :value="old('end_date', $experience->end_date)"

                />
                 {{-- responsibilities --}}
                <x-forms.input
                    class="col-md-6"
                    label="Responsabilités"
                    name="responsibilities"
                    required="required"
                    :value="old('responsibilities', $experience->responsibilities)"
                />

            </div>
            <x-buttons.save
                container="edit-experience-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

