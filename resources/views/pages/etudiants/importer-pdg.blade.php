<x-modal-header-body
    :title="' Importer Inscription Pdg'"
>
{{-- importer les documents de l'étudiant --}}
<div id="importer-inscription-pdg-form">
    <form
        action="{{ route('etudiants.importer.inscriptions_pdg.store') }}"
        method="POST">
        @csrf
        {{-- importer les documents de l'étudiant --}}
        <x-forms.input
            label="Document"
            name="document"
            required="required"
            type="file"
        />
        <x-buttons.save
            container="importer-inscription-pdg-form"
            onclick="saveForm({ element: this })"
        />
    </form>
</div>
</x-modal-header-body>
