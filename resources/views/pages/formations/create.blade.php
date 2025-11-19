<x-modal-header-body
    :title="__('formations.create')"
>
    <div id="create-formation-form">
        <form
            action="{{ route('formations.store') }}"
            method="POST"
            id="create-formation-form"
            class="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Diplôme"
                    name="degree"
                    required="required"
                    value="{{ old('degree') }}"
                />
                {{-- institution --}}
                <x-forms.input
                    class="col-md-6"
                    label="Institution"
                    name="institution"
                    required="required"
                    value="{{ old('institution') }}"
                />
                {{-- start_year --}}
                <x-forms.input
                    class="col-md-6"
                    label="Année de début"
                    name="start_year"
                    required="required"
                    type="year"
                    value="{{ old('start_year') }}"
                />
                {{-- end_year --}}
                <x-forms.input
                    class="col-md-6"
                    label="Année de fin"
                    name="end_year"
                    type="year"
                    required="required"
                    value="{{ old('end_year') }}"
                />
                {{-- description --}}
                <x-forms.input
                    class="col-md-6"
                    label="Description"
                    name="description"
                    required="required"
                    value="{{ old('description') }}"
                />
        </div>
            <x-buttons.save
                container="create-formation-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
