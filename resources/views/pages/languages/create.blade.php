<x-modal-header-body
    :title="__('languages.create')"
>
    <div id="create-language-form">
        <form
            action="{{ route('languages.store') }}"
            method="POST"
            id="create-language-form"
            class="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Langue"
                    name="language"
                    required="required"
                    value="{{ old('language') }}"
                />
                {{-- niveau --}}
                <x-forms.input
                    class="col-md-6"
                    label="Niveau"
                    name="niveau"
                    required="required"
                    value="{{ old('niveau') }}"
                />

            </div>
            <x-buttons.save
                container="create-language-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
