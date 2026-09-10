<x-modal-header-body
    :title="__('actualites.create')"
>
    <div id="create-actualite-form">
        <form
            action="{{ route('actualites.store') }}"
            method="POST"
            id="create-actualite-form"
            class="form"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Titre (FR)"
                    name="titre_fr"
                    required="required"
                    value="{{ old('titre_fr') }}"
                />
                {{-- titre (EN) --}}
                <x-forms.input
                    class="col-md-6"
                    label="Titre (EN)"
                    name="titre_en"
                    required="required"
                    value="{{ old('titre_en') }}"
                />
                {{-- titre (AR) --}}
                <x-forms.input
                    class="col-md-6"
                    label="Titre (AR)"
                    name="titre_ar"
                    required="required"
                    value="{{ old('titre_ar') }}"
                />
                {{-- auteur --}}
                <x-forms.input
                    class="col-md-6"
                    label="Auteur"
                    name="auteur"
                    required="required"
                    value="{{ old('auteur') }}"
                />
                {{-- contenu (FR) --}}
                <x-forms.textarea
                    class="col-md-12"
                    editorClass="tinymce-editor"
                    label="Contenu (FR) 😀"
                    name="contenu_fr"
                    required="required"
                    value="{{ old('contenu_fr') }}"
                />
                {{-- contenu (EN) --}}
                <x-forms.textarea
                    class="col-md-12"
                    editorClass="tinymce-editor"
                    label="Contenu (EN) 😀"
                    name="contenu_en"
                    required="required"
                    value="{{ old('contenu_en') }}"
                />
                {{-- contenu (AR) --}}
                <x-forms.textarea
                    class="col-md-12"
                    editorClass="tinymce-editor-rtl"
                    label="Contenu (AR) 😀"
                    name="contenu_ar"
                    required="required"
                    value="{{ old('contenu_ar') }}"
                />
                {{-- statut  --}}
                <x-forms.select
                    class="col-md-6"
                    label="Statut"
                    name="statut"
                    required="required"
                    :options="[
                        'publie' => 'Publié',
                        'brouillon' => 'Brouillon',
                    ]"
                />

                {{-- image de couverture --}}
                <x-forms.input
                    class="col-md-6"
                    label="Image de couverture"
                    name="image"
                    type="file"
                />

                {{-- photos --}}
                <x-forms.file
                    class="col-md-6"
                    label="📷 Photos (sélection multiple possible)"
                    name="images[]"
                    accept="image/*"
                    :multiple="true"
                    :previewMultiple="true"
                />

                {{-- videos --}}
                <x-forms.file
                    class="col-md-6"
                    label="🎥 Vidéos (sélection multiple possible)"
                    name="videos[]"
                    accept="video/*"
                    :multiple="true"
                    :previewMultiple="true"
                />

                {{-- fichiers telechargeables --}}
                <div class="col-12 mb-3">
                    <label class="d-block fw-bold">📎 Fichiers téléchargeables</label>
                    <p class="text-muted small mb-2">Sélectionnez plusieurs fichiers en une seule fois, puis complétez le nom et la description de chacun (FR / AR).</p>
                    <div class="fichiers-uploader">
                        <input type="file" name="fichiers[]" class="js-multi-file-input form-control mb-2" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
                        <div class="fichiers-rows"></div>
                    </div>
                </div>
            </div>
            <x-buttons.save
                container="create-actualite-form"
                onclick="saveForm({ element: this  })"
            />
        </form>
    </div>
</x-modal-header-body>
