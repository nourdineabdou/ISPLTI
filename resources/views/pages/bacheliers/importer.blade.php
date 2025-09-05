<x-modal-header-body
    :title="__('etudiants.importer')"
>
{{-- importer les documents de l'étudiant --}}
<div id="importer-etudiant-form">
    <form
        action="{{ route('etudiants.importer') }}"
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
            container="importer-etudiant-form"
            onclick="saveForm({ element: this })"
        />
    </form>
</x-modal-header-body>

