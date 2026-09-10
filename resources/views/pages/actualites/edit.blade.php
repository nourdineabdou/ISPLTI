<x-modal-header-body
    :title="__('actualites.edit')"
>
    <div id="edit-actualite-form">
        <form
            action="{{ route('actualites.update', $actualite) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Titre (FR)"
                    name="titre_fr"
                    required="required"
                    :value="$actualite->titre_fr"
                />
                {{-- titre (EN) --}}
                <x-forms.input
                    class="col-md-6"
                    label="Titre (EN)"
                    name="titre_en"
                    required="required"
                    :value="$actualite->titre_en"
                />
                {{-- titre (AR) --}}
                <x-forms.input
                    class="col-md-6"
                    label="Titre (AR)"
                    name="titre_ar"
                    required="required"
                    :value="$actualite->titre_ar"
                />
                {{-- auteur --}}
                <x-forms.input
                    class="col-md-6"
                    label="Auteur"
                    name="auteur"
                    required="required"
                    :value="$actualite->auteur"
                />
                {{-- contenu (FR) --}}
                <x-forms.textarea
                    class="col-md-12"
                    editorClass="tinymce-editor"
                    label="Contenu (FR) 😀"
                    name="contenu_fr"
                    required="required"
                    :value="$actualite->contenu_fr"
                />
                {{-- contenu (EN) --}}
                <x-forms.textarea
                    class="col-md-12"
                    editorClass="tinymce-editor"
                    label="Contenu (EN) 😀"
                    name="contenu_en"
                    required="required"
                    :value="$actualite->contenu_en"
                />
                {{-- contenu (AR) --}}
                <x-forms.textarea
                    class="col-md-12"
                    editorClass="tinymce-editor-rtl"
                    label="Contenu (AR) 😀"
                    name="contenu_ar"
                    required="required"
                    :value="$actualite->contenu_ar"
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
                    :value="$actualite->statut"
                />
                {{-- image de couverture --}}
                <x-forms.input
                    class="col-md-6"
                    label="Image de couverture"
                    name="image"
                    type="file"
                />

                {{-- photos existantes --}}
                @if($actualite->images->count())
                    <div class="col-12 mb-2">
                        <label class="d-block">Photos existantes</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($actualite->images as $image)
                                <div class="border rounded p-1 text-center" style="width:100px;">
                                    <img src="{{ asset($image->chemin) }}" class="img-fluid mb-1" style="height:60px;object-fit:cover;">
                                    <div class="form-check form-check-sm">
                                        <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                        <label class="form-check-label small" for="delete_image_{{ $image->id }}">Supprimer</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                {{-- ajouter des photos --}}
                <x-forms.file
                    class="col-md-6"
                    label="📷 Ajouter des photos (sélection multiple possible)"
                    name="images[]"
                    accept="image/*"
                    :multiple="true"
                    :previewMultiple="true"
                />

                {{-- videos existantes --}}
                @if($actualite->videos->count())
                    <div class="col-12 mb-2">
                        <label class="d-block">Vidéos existantes</label>
                        @foreach($actualite->videos as $video)
                            <div class="form-check form-check-sm">
                                <input class="form-check-input" type="checkbox" name="delete_videos[]" value="{{ $video->id }}" id="delete_video_{{ $video->id }}">
                                <label class="form-check-label small" for="delete_video_{{ $video->id }}">Supprimer {{ basename($video->chemin) }}</label>
                            </div>
                        @endforeach
                    </div>
                @endif
                {{-- ajouter des videos --}}
                <x-forms.file
                    class="col-md-6"
                    label="🎥 Ajouter des vidéos (sélection multiple possible)"
                    name="videos[]"
                    accept="video/*"
                    :multiple="true"
                    :previewMultiple="true"
                />

                {{-- fichiers existants --}}
                @if($actualite->fichiers->count())
                    <div class="col-12 mb-2">
                        <label class="d-block">Fichiers existants</label>
                        @foreach($actualite->fichiers as $fichier)
                            <div class="form-check form-check-sm">
                                <input class="form-check-input" type="checkbox" name="delete_fichiers[]" value="{{ $fichier->id }}" id="delete_fichier_{{ $fichier->id }}">
                                <label class="form-check-label small" for="delete_fichier_{{ $fichier->id }}">Supprimer « {{ $fichier->nom_fr }} @if($fichier->nom_ar) / {{ $fichier->nom_ar }} @endif »</label>
                            </div>
                        @endforeach
                    </div>
                @endif
                {{-- ajouter des fichiers --}}
                <div class="col-12 mb-3">
                    <label class="d-block fw-bold">📎 Ajouter des fichiers téléchargeables</label>
                    <p class="text-muted small mb-2">Sélectionnez plusieurs fichiers en une seule fois, puis complétez le nom et la description de chacun (FR / AR).</p>
                    <div class="fichiers-uploader">
                        <input type="file" name="fichiers[]" class="js-multi-file-input form-control mb-2" multiple accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
                        <div class="fichiers-rows"></div>
                    </div>
                </div>
            </div>
            <x-buttons.save
                container="edit-actualite-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>
