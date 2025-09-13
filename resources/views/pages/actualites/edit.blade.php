<x-modal-header-body
    :title="__('actualites.edit')"
>
    <div id="edit-actualite-form">
        <form
            action="{{ route('actualites.update', $actualite) }}"
            method="POST">
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
                {{-- contenu (FR) --}}
                <x-forms.textarea
                    class="col-md-6"
                    label="Contenu (FR)"
                    name="contenu_fr"
                    required="required"
                    :value="$actualite->contenu_fr"
                />
                {{-- contenu (EN) --}}
                <x-forms.textarea
                    class="col-md-6"
                    label="Contenu (EN)"
                    name="contenu_en"
                    required="required"
                    :value="$actualite->contenu_en"
                />
                {{-- contenu (AR) --}}
                <x-forms.textarea
                    class="col-md-6"
                    label="Contenu (AR)"
                    name="contenu_ar"
                    required="required"
                    :value="$actualite->contenu_ar"
                />
                {{-- auteur --}}
                <x-forms.input
                    class="col-md-6"
                    label="Auteur"
                    name="auteur"
                    required="required"
                    :value="$actualite->auteur"
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
                {{-- image --}}
                <x-forms.input
                    class="col-md-6"
                    label="Image"
                    name="image"
                    type="file"
                />
            </div>
            <x-buttons.save
                container="edit-actualite-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

