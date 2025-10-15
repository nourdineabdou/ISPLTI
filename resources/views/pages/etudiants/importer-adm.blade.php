<x-modal-header-body
    :title="' Importer Inscription Adm'"
>
{{-- importer les documents de l'étudiant --}}
<div id="importer-inscription-adm-form">
    <form
        action="{{ route('etudiants.importer.inscriptions_adm.store') }}"
        method="POST"

        enctype="multipart/form-data">
        @csrf
        {{-- importer les documents de l'étudiant --}}
        <x-forms.input
            label="Document"
            name="document"
            required="required"
            type="file"
        />
        <x-buttons.save
            container="importer-inscription-adm-form"
            onclick="saveForm({ element: this })"
        />
    </form>
</div>
</x-modal-header-body>
