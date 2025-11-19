

<x-layouts.main
    :title="$title"
>

<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-x-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="{{ route('etudiants.image', $etudiant->id) }}" alt="Photo {{ $etudiant->nom_fr ?? $etudiant->nom }}" class="rounded-circle" style="width:140px;height:140px;object-fit:cover;border:4px solid #6366f1;">
                    </div>
                    <h4 class="mb-0">{{ $etudiant->nom_fr ?? $etudiant->nom }}</h4>
                    <div class="text-muted mb-2">{{ $etudiant->niveau ?? '-' }}</div>
                    <div class="mb-3">
                        <span class="badge bg-primary me-1">N° DOS: {{ $etudiant->nodos ?? '-' }}</span>
                        <span class="badge bg-secondary">NNI: {{ $etudiant->nni ?? '-' }}</span>
                    </div>

                    <form action="{{ route('etudiants.updatePhoto', $etudiant->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-camera"></i> Changer la photo
                            <input type="file" name="photo" accept="image/*" class="d-none" onchange="this.form.submit()">
                        </label>
                    </form>

                    <div class="mt-3">
                        <a
                        {{--
                            onclick="openInModal({ link: '{{ route('etudiants.edit', $etudiant->id) }}', size: 'md' })"
                        --}}
                        href="#"
                        class="btn btn-outline-secondary btn-sm">Modifier le profil</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="mb-3">Informations personnelles</h5>
                    <div class="row">
                        <div class="col-sm-6 mb-2"><strong>Nom (FR):</strong> {{ $etudiant->nom_fr ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Nom (AR):</strong> {{ $etudiant->nom_ar ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Date de naissance:</strong> {{ $etudiant->date_naissance ? \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') : '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Lieu de naissance:</strong> {{ $etudiant->lieu_naissance_fr ?? $etudiant->lieu_naissance ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Téléphone:</strong> {{ $etudiant->telephone ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Email:</strong> {{ $etudiant->email ?? '-' }}</div>
                        <div class="col-12 mb-2"><strong>Adresse:</strong> {{ $etudiant->adresse ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">Sécurité du compte</h5>
                    <p class="text-muted small">Changer le mot de passe de l'utilisateur associé à ce profil.</p>
                    <form action="{{ route('etudiants.updatePassword', $etudiant->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nouveau mot de passe</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" required minlength="6" id="newPassword">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('newPassword')"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmer le mot de passe</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" class="form-control" required id="confirmPassword">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirmPassword')"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
                            <a href="{{ route("home") }}" class="btn btn-outline-secondary">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(id){
        const el = document.getElementById(id);
        if(!el) return;
        el.type = el.type === 'password' ? 'text' : 'password';
    }
</script>

</x-layouts.main>
