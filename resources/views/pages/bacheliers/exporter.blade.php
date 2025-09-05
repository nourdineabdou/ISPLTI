<x-modal-header-body
    :title="__('etudiants.exporter')"
>
{{-- exporter les documents de l'étudiant --}}
<div id="exporter-etudiant-form">
    <form
        action="{{ route('etudiants.exporter') }}"
        method="POST">
        @csrf
        {{-- exporter les documents de l'étudiant --}}
        <x-forms.input
            label="Document"
            name="document"
            required="required"
            type="file"
        />
        <x-buttons.save
            container="exporter-etudiant-form"
            onclick="saveForm({ element: this })"
        />
    </form>
</x-modal-header-body>

