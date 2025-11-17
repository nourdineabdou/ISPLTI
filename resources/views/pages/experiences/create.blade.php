<x-modal-header-body
    :title="__('experiences.create')"
>
    <div id="create-experience-form">
        <form
            action="{{ route('experiences.store') }}"
            method="POST"
            id="create-experience-form"
            class="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Intitulé du poste"
                    name="job_title"
                    required="required"
                    value="{{ old('job_title') }}"
                />
                {{-- institution --}}
                <x-forms.input
                    class="col-md-6"
                    label="Institution"
                    name="institution"
                    required="required"
                    value="{{ old('institution') }}"
                />
                {{-- start_date --}}
                <x-forms.input
                    class="col-md-6"
                    label="Date de début"
                    name="start_date"
                    type="date"
                    required="required"
                    value="{{ old('start_date') }}"
                />
                {{-- end_date --}}
                <x-forms.input
                    class="col-md-6"
                    label="Date de fin"
                    name="end_date"
                    type="date"
                    required="required"
                    value="{{ old('end_date') }}"
                />
                {{-- responsibilities --}}
                <x-forms.input
                    class="col-md-6"
                    label="Responsabilités"
                    name="responsibilities"
                    required="required"
                    value="{{ old('responsibilities') }}"
                />
            </div>
            <x-buttons.save
                container="create-experience-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
