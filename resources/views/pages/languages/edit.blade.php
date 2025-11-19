<x-modal-header-body
    :title="__('languages.edit')"
>
    <div id="edit-language-form">
        <form
            action="{{ route('languages.update', $language->id) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                 <x-forms.input
                    class="col-md-6"
                    label="Langue"
                    name="language"
                    required="required"
                    value="{{ old('language' , $language->language) }}"
                />
                {{-- niveau --}}
                <x-forms.input
                    class="col-md-6"
                    label="Niveau"
                    name="niveau"
                    required="required"
                    value="{{ old('niveau' , $language->niveau) }}"
                />
            </div>
            <x-buttons.save
                container="edit-language-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

