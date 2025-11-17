<x-layouts.main
    :title="__('Espace Professeur')"
>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body d-flex align-items-center">
                            <img src="{{ asset($professeur->image) }}" alt="Photo de profil" class="rounded-circle mr-4" width="100" height="100">
                            <div class="ml-4">
                                <h3 class="mb-1">{{ $professeur->nom }} {{ $professeur->prenom }}</h3>
                                <p class="mb-0 text-muted">{{ $professeur->specialite }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">Matières / Cours enseignés</div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @php
                                    $nbreEtu = 0;
                                @endphp
                                @foreach (\App\Models\MatiereProfesseur::where('professeur_id', $professeur->id)->get() as $matiereProfesseur)
                                    @php
                                        $matiere = \App\Models\Matiere::find($matiereProfesseur->matiere_id);
                                        $nbreEtu = +$matiereProfesseur->nbreEtudiant;
                                    @endphp
                                    @if($matiere)
                                        <li class="list-group-item">{{ $matiere->nom }}</li>
                                        <li class="list-group-item">{{ $matiereProfesseur->code_specialite }}</li>
                                        <li class="list-group-item">{{ $matiereProfesseur->nbreEtudiant }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{--
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-success text-white">Niveaux d’étude associés</div>
                            <div class="card-body">
                                <span class="badge badge-info mr-2">Licence 1</span>
                                <span class="badge badge-info mr-2">Licence 2</span>
                                <span class="badge badge-info">Master 1</span>
                            </div>
                        </div>
                    </div>
                --}}
            </div>
            {{--
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">Nombre total d’étudiants</div>
                <div class="card-body">
                    <h2 class="display-4">{{ $nbreEtu }}</h2>
                    <p class="mb-0">Étudiants inscrits dans ses cours</p>
                </div>
            </div>
            --}}
            <!-- CV Professeur -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">CV du Professeur</div>
                <div class="card-body">
                    <!-- Formation -->
                    <h5 class="mb-3 text-primary"><i class="bi bi-mortarboard me-2"></i>Formation</h5>
                    <ul class="list-group mb-4">
                        @forelse($professeurEducations as $edu)
                            <li class="list-group-item">
                                <strong>{{ $edu->degree ?? '-' }}</strong> — {{ $edu->institution ?? '-' }}<br>
                                <span class="text-muted">{{ $edu->start_year ?? '-' }} - {{ $edu->end_year ?? '-' }}</span>
                                @if(!empty($edu->description))<div class="small text-muted mt-1">{{ $edu->description }}</div>@endif
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Aucune formation renseignée.</li>
                        @endforelse
                    </ul>
                    <!-- Expérience -->
                    <h5 class="mb-3 text-success"><i class="bi bi-briefcase me-2"></i>Expérience</h5>
                    <ul class="list-group mb-4">
                        @forelse($professeurExperiences as $exp)
                            <li class="list-group-item">
                                <strong>{{ $exp->job_title ?? '-' }}</strong> — {{ $exp->institution ?? '-' }}<br>
                                <span class="text-muted">{{ $exp->start_date ?? '-' }} - {{ $exp->end_date ?? 'Aujourd\'hui' }}</span>
                                @if(!empty($exp->responsibilities))<div class="small text-muted mt-1">{{ $exp->responsibilities }}</div>@endif
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Aucune expérience renseignée.</li>
                        @endforelse
                    </ul>
                    <!-- Langues -->
                    <h5 class="mb-3 text-warning"><i class="bi bi-translate me-2"></i>Langues</h5>
                    <ul class="list-group">
                        @forelse($professeurLanguages as $lang)
                            <li class="list-group-item">
                                <strong>{{ $lang->language ?? '-' }}</strong> — <span class="text-muted">{{ $lang->niveau ?? '-' }}</span>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Aucune langue renseignée.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.main>
