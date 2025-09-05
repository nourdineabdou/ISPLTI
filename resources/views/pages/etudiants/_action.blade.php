<div class="btn-group btn-group-sm">
    <button
        class="btn btn-success"
        onclick="openInModal({ link: '{{ route('etudiants.edit', $etudiant->id) }}' })"
    >
        <i class="la la-pencil"></i>
    </button>
    <button
        class="btn btn-danger"
        onclick="confirmDelete('{{ route('etudiants.destroy', $etudiant->id) }}')"
    >
        <i class="la la-trash"></i>
    </button>
</div>
