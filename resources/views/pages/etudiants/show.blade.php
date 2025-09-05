
<x-modal-header-body
    :title="__('Voir Étudiant')"
    :actions="$actions"
>
    <div class="container py-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-12 col-md-4 text-center">
                        @if($etudiant->id)
                            <img src="{{ url('/etudiants/image/' . $etudiant->id) }}" alt="Photo {{$etudiant->nom_fr ?? $etudiant->nom ?? ''}}" class="etudiant-photo img-fluid rounded" style="width:160px;height:160px;object-fit:cover;border-radius:12px;box-shadow:0 6px 18px rgba(2,6,23,0.12);">
                        @else
                            <div class="bg-secondary text-white rounded d-inline-flex align-items-center justify-content-center" style="width:160px;height:160px;font-size:48px;border-radius:12px;box-shadow:0 6px 18px rgba(2,6,23,0.12);">
                                {{ strtoupper(substr(($etudiant->nom_fr ?? $etudiant->nom ?? 'U'),0,1)) }}
                            </div>
                        @endif

                        <div class="mt-3">
                            <h5 class="mb-0">{{ $etudiant->nom_fr  }}</h5>
                            <small class="text-muted">{{ $etudiant->nodos ? 'N° DOS: '.$etudiant->nodos : '' }}</small>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="mb-3">
                            <h6 class="mb-1">Information personnelle</h6>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Nom (FR):</strong> {{ $etudiant->nom_fr ?? '-' }}</li>
                                        <li><strong>Nom (AR):</strong> {{ $etudiant->nom_ar ?? '-' }}</li>
                                        <li><strong>Lieu naissance (FR):</strong> {{ $etudiant->lieu_naissance_fr ?? $etudiant->lieu_naissance ?? '-' }}</li>
                                        <li><strong>Lieu naissance (AR):</strong> {{ $etudiant->lieu_naissance_ar ?? '-' }}</li>
                                        <li><strong>Date de naissance:</strong> {{ $etudiant->date_naissance ? date('d/m/Y', strtotime($etudiant->date_naissance)) : '-' }}</li>
                                        <li><strong>Genre:</strong> {{ $etudiant->genre ?? '-' }}</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Téléphone:</strong> {{ $etudiant->telephone ?? '-' }}</li>
                                        <li><strong>Email:</strong> {{ $etudiant->email ?? '-' }}</li>
                                        <li><strong>Adresse:</strong> {{ $etudiant->adresse ?? '-' }}</li>
                                        <li><strong>Nationalité:</strong> {{ $etudiant->nationalite ?? '-' }}</li>
                                        <li><strong>État bourse:</strong> {{ isset($etudiant->etat_bourse) ? ($etudiant->etat_bourse ? 'Oui' : 'Non') : '-' }}</li>
                                        <li><strong>NNI:</strong> {{ $etudiant->nni ?? '-' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-1">Informations académiques</h6>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Numéro BAC:</strong> {{ $etudiant->num_bac ?? '-' }}</li>
                                        <li><strong>Année d'entrée:</strong> {{ $etudiant->annee_entree_etabliss ?? '-' }}</li>
                                        <li><strong>Établissement (ID):</strong> {{ $etudiant->id_etablissement ?? '-' }}</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Numéro dérogation:</strong> {{ $etudiant->num_derogation ?? '-' }}</li>
                                        <li><strong>Date dérogation:</strong> {{ $etudiant->date_derogation ? date('d/m/Y', strtotime($etudiant->date_derogation)) : '-' }}</li>
                                        <li><strong>Situation familiale (ID):</strong> {{ $etudiant->id_situation_familiale ?? '-' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="mb-1">Métadonnées</h6>
                            <ul class="list-unstyled mb-0">
                                <li><strong>ID:</strong> {{ $etudiant->id ?? '-' }}</li>
                                <li><strong>Date ajout:</strong> {{ $etudiant->date_ajout ?? '-' }}</li>
                                <li><strong>Date maj:</strong> {{ $etudiant->date_maj ?? '-' }}</li>
                                <li><strong>Personnel (ID):</strong> {{ $etudiant->id_personnel ?? '-' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-modal-header-body>
