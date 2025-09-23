
<x-modal-header-body
    :title="__('Voir Bachelier') . ' - ' . ($bachelier->nom_fr ?? $bachelier->nom ?? '')"
    :actions="$actions"
>
    <div class="container py-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-12 col-md-4 text-center">
                        @if($bachelier->id)
                            <img src="{{ url('/bacheliers/image/' . $bachelier->id) }}" alt="Photo {{$bachelier->nom_fr ?? $bachelier->nom ?? ''}}" class="bachelier-photo img-fluid rounded" style="width:160px;height:160px;object-fit:cover;border-radius:12px;box-shadow:0 6px 18px rgba(2,6,23,0.12);">
                        @else
                            <div class="bg-secondary text-white rounded d-inline-flex align-items-center justify-content-center" style="width:160px;height:160px;font-size:48px;border-radius:12px;box-shadow:0 6px 18px rgba(2,6,23,0.12);">
                                {{ strtoupper(substr(($bachelier->nom_fr ?? $bachelier->nom ?? 'U'),0,1)) }}
                            </div>
                        @endif

                        <div class="mt-3">
                            <h5 class="mb-0">{{ $bachelier->nom_fr  }}</h5>
                            <small class="text-muted">{{ $bachelier->nodos ? 'N° DOS: '.$bachelier->nodos : '' }}</small>
                            <!-- Download ZIP button -->
                            <div class="mt-3">
                                <a href="{{ route('bacheliers.exporter_dossier', $bachelier->id) }}" class="btn btn-primary" target="_blank">
                                    <i class="bi bi-file-earmark-zip"></i> @lang('Télécharger le dossier ZIP')
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-8">
                        <div class="mb-3">
                            <h6 class="mb-1">Information personnelle</h6>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Nom (FR):</strong> {{ $bachelier->nom_fr ?? '-' }}</li>
                                        <li><strong>Nom (AR):</strong> {{ $bachelier->nom_ar ?? '-' }}</li>
                                        <li><strong>Lieu naissance (FR):</strong> {{ $bachelier->lieu_naissance_fr ?? $bachelier->lieu_naissance ?? '-' }}</li>
                                        <li><strong>Lieu naissance (AR):</strong> {{ $bachelier->lieu_naissance_ar ?? '-' }}</li>
                                        <li><strong>Date de naissance:</strong> {{ $bachelier->date_naissance ? date('d/m/Y', strtotime($bachelier->date_naissance)) : '-' }}</li>
                                        <li><strong>Genre:</strong> {{ $bachelier->genre ?? '-' }}</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Téléphone:</strong> {{ $bachelier->telephone ?? '-' }}</li>
                                        <li><strong>Email:</strong> {{ $bachelier->email ?? '-' }}</li>
                                        <li><strong>Adresse:</strong> {{ $bachelier->adresse ?? '-' }}</li>
                                        <li><strong>Nationalité:</strong> {{ $bachelier->nationalite ?? '-' }}</li>
                                        <li><strong>État bourse:</strong> {{ isset($bachelier->etat_bourse) ? ($bachelier->etat_bourse ? 'Oui' : 'Non') : '-' }}</li>
                                        <li><strong>NNI:</strong> {{ $bachelier->nni ?? '-' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6 class="mb-1">Informations académiques</h6>
                            <div class="row">
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Numéro BAC:</strong> {{ $bachelier->num_bac ?? '-' }}</li>
                                        <li><strong>Année d'entrée:</strong> {{ $bachelier->annee_entree_etabliss ?? '-' }}</li>
                                        <li><strong>Établissement (ID):</strong> {{ $bachelier->id_etablissement ?? '-' }}</li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><strong>Numéro dérogation:</strong> {{ $bachelier->num_derogation ?? '-' }}</li>
                                        <li><strong>Date dérogation:</strong> {{ $bachelier->date_derogation ? date('d/m/Y', strtotime($bachelier->date_derogation)) : '-' }}</li>
                                        <li><strong>Situation familiale (ID):</strong> {{ $bachelier->id_situation_familiale ?? '-' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="mb-1">Métadonnées</h6>
                            <ul class="list-unstyled mb-0">
                                <li><strong>ID:</strong> {{ $bachelier->id ?? '-' }}</li>
                                <li><strong>Date ajout:</strong> {{ $bachelier->date_ajout ?? '-' }}</li>
                                <li><strong>Date maj:</strong> {{ $bachelier->date_maj ?? '-' }}</li>
                                <li><strong>Personnel (ID):</strong> {{ $bachelier->id_personnel ?? '-' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-modal-header-body>
