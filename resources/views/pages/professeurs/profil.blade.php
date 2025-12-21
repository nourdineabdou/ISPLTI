<x-layouts.main
    :title="$title"
>
<div class="container py-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="{{ route('professeurs.getImage', $professeur->id) }}" alt="Photo de profil" class="rounded-circle border border-3" style="width:120px;height:120px;object-fit:cover;">
                        <form action="{{ route('professeurs.updatePhoto', $professeur->id) }}" method="POST" enctype="multipart/form-data" class="mt-2">
                            @csrf
                            <label class="btn btn-sm btn-outline-primary position-absolute bottom-0 start-50 translate-middle-x" style="z-index:2;">
                                <i class="bi bi-pencil-square"></i> Modifier la photo
                                <input type="file" name="image" accept="image/*" class="d-none" onchange="this.form.submit()">
                            </label>
                        </form>
                    </div>
                    <h2 class="mb-1">{{ $professeur->nom }}</h2>
                    <div class="text-muted mb-2">{{ $professeur->specialite }}</div>
                    <div class="mb-2"><i class="bi bi-envelope me-1"></i> {{ $professeur->email }}</div>
                    <div class="mb-2"><i class="bi bi-phone me-1"></i> {{ $professeur->telephone }}</div>
                    <div class="mb-2"><i class="bi bi-geo-alt me-1"></i> {{ $professeur->adresse }}</div>
                    <div class="mb-2"><i class="bi bi-calendar me-1"></i> Date de naissance : {{ $professeur->date_naissance }}</div>
                    <div class="mb-2"><i class="bi bi-person-badge me-1"></i> N° Matricule : {{ $professeur->matricule }}</div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-outline-secondary me-2" onclick="openInModal({ link: '{{ route('professeurs.edit', $professeur->id) }}', size: 'lg' })">
                            <i class="bi bi-pencil"></i> Modifier les informations
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.main>
