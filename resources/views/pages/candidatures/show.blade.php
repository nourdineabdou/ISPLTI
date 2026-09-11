<x-layouts.main
    :title="'Candidature ' . $candidature->numero_candidature"
>
<div class="container-fluid py-3">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-12 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    @if($photo)
                        <img src="{{ route('candidatures.document', [$candidature->id, $photo->id]) }}" alt="Photo" class="rounded-circle mb-3" style="width:140px;height:140px;object-fit:cover;border:4px solid #08915e;">
                    @else
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3" style="width:140px;height:140px;font-size:2.5rem;">
                            {{ strtoupper(substr($candidature->nom, 0, 1)) }}
                        </div>
                    @endif
                    <h4 class="mb-0">{{ $candidature->prenom }} {{ $candidature->nom }}</h4>
                    <div class="text-muted mb-2">{{ $candidature->master->intitule ?? '-' }}</div>
                    <div class="mb-3">
                        <span class="badge badge-primary">{{ $candidature->numero_candidature }}</span>
                        <span class="badge badge-secondary">NNI: {{ $candidature->nni }}</span>
                    </div>

                    <div class="mb-3">
                        @php
                            $badges = ['brouillon'=>'secondary','soumis'=>'info','en_cours'=>'warning','accepte'=>'success','refuse'=>'danger'];
                            $couleur = $badges[$candidature->statut] ?? 'secondary';
                        @endphp
                        <span class="badge badge-{{ $couleur }} p-2">Statut : {{ ucfirst($candidature->statut) }}</span>
                    </div>

                    <a href="{{ route('candidatures.zip', $candidature->id) }}" class="btn btn-outline-primary btn-sm mb-3 d-block">
                        <i class="bi bi-file-earmark-zip"></i> Télécharger le dossier ZIP
                    </a>

                    <div class="btn-group d-flex flex-wrap gap-1 mb-3">
                        @foreach(['soumis'=>'Marquer soumis','en_cours'=>'En cours'] as $statut => $label)
                            <a href="{{ route('candidatures.statut', [$candidature->id, $statut]) }}"
                               onclick="return confirm('Confirmer : {{ $label }} ?')"
                               class="btn btn-sm btn-outline-secondary">{{ $label }}</a>
                        @endforeach
                    </div>

                    @if(!in_array($candidature->statut, ['accepte', 'refuse']))
                        <form action="{{ route('candidatures.decision', $candidature->id) }}" method="POST" class="text-start">
                            @csrf
                            <label class="form-label small">Commentaire (envoyé au candidat s'il est refusé)</label>
                            <textarea name="commentaire_admin" class="form-control form-control-sm mb-2" rows="2">{{ old('commentaire_admin', $candidature->commentaire_admin) }}</textarea>
                            <div class="d-flex gap-1">
                                <button type="submit" name="decision" value="accepte" class="btn btn-sm btn-success flex-fill" onclick="return confirm('Confirmer l\'acceptation ? Un email sera envoyé au candidat.')">✓ Accepter</button>
                                <button type="submit" name="decision" value="refuse" class="btn btn-sm btn-danger flex-fill" onclick="return confirm('Confirmer le refus ? Un email sera envoyé au candidat.')">✕ Refuser</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-{{ $candidature->statut === 'accepte' ? 'success' : 'danger' }} small mb-2">
                            Décision déjà envoyée : <strong>{{ $candidature->statut === 'accepte' ? 'Acceptée' : 'Refusée' }}</strong>
                            @if($candidature->commentaire_admin)<br>{{ $candidature->commentaire_admin }}@endif
                        </div>
                        <form action="{{ route('candidatures.renvoyerEmail', $candidature->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary w-100" data-loading-text="Envoi en cours...">
                                📤 Renvoyer l'email au candidat
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="mb-3">Identité</h5>
                    <div class="row">
                        <div class="col-sm-6 mb-2"><strong>Sexe:</strong> {{ $candidature->sexe ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Date de naissance:</strong> {{ optional($candidature->date_naissance)->format('d/m/Y') ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Lieu de naissance:</strong> {{ $candidature->lieu_naissance ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Nationalité:</strong> {{ $candidature->nationalite ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Téléphone:</strong> {{ $candidature->telephone ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>WhatsApp:</strong> {{ $candidature->whatsapp ?? '-' }}</div>
                        <div class="col-sm-6 mb-2"><strong>Email:</strong> {{ $candidature->email }}</div>
                        <div class="col-sm-6 mb-2"><strong>Soumise le:</strong> {{ optional($candidature->date_soumission)->format('d/m/Y H:i') ?? '-' }}</div>
                        <div class="col-12 mb-2"><strong>Adresse:</strong> {{ $candidature->adresse ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="mb-3">Situation professionnelle</h5>
                    <div class="row">
                        <div class="col-sm-4 mb-2"><strong>Situation:</strong> {{ $candidature->situation_professionnelle ?? '-' }}</div>
                        <div class="col-sm-4 mb-2"><strong>Profession:</strong> {{ $candidature->profession ?? '-' }}</div>
                        <div class="col-sm-4 mb-2"><strong>Employeur:</strong> {{ $candidature->organisme_employeur ?? '-' }}</div>
                    </div>
                    @if($candidature->experiencesProfessionnelles->count())
                        <hr>
                        @foreach($candidature->experiencesProfessionnelles as $exp)
                            <div class="mb-2 pb-2 border-bottom">
                                <strong>{{ $exp->poste ?? '-' }}</strong> — {{ $exp->employeur }}
                                <div class="small text-muted">{{ optional($exp->date_debut)->format('d/m/Y') }} → {{ optional($exp->date_fin)->format('d/m/Y') ?? 'présent' }}</div>
                                @if($exp->description)<div class="small">{{ $exp->description }}</div>@endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            @if($candidature->formations->count())
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Formations complémentaires</h5>
                        @foreach($candidature->formations as $f)
                            <div class="mb-2 pb-2 border-bottom">
                                <strong>{{ $f->intitule }}</strong> {{ $f->organisme ? '— '.$f->organisme : '' }}
                                <div class="small text-muted">{{ optional($f->date_debut)->format('d/m/Y') }} → {{ optional($f->date_fin)->format('d/m/Y') }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($candidature->diplomes->count())
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Diplômes</h5>
                        @foreach($candidature->diplomes as $d)
                            <div class="mb-2 pb-2 border-bottom">
                                <strong>{{ $d->type_diplome }} — {{ $d->intitule }}</strong>
                                <div class="small text-muted">{{ $d->etablissement }} {{ $d->pays ? '('.$d->pays.')' : '' }} — {{ $d->annee_obtention }} {{ $d->mention ? '— '.$d->mention : '' }}</div>
                                <div class="small">
                                    @if($d->fichier_diplome)<a href="{{ route('candidatures.fichier', $candidature->id) }}?path={{ urlencode($d->fichier_diplome) }}" target="_blank">📄 Diplôme</a>@endif
                                    @if($d->fichier_releve)&nbsp;| <a href="{{ route('candidatures.fichier', $candidature->id) }}?path={{ urlencode($d->fichier_releve) }}" target="_blank">📄 Relevé</a>@endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($candidature->langues->count())
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Langues</h5>
                        @foreach($candidature->langues as $l)
                            <span class="badge badge-light border mr-2 mb-2 p-2">
                                {{ optional($l->langue)->langue }} — {{ $l->niveau }} ({{ $l->type }})
                                @if($l->fichier_certificat)
                                    <a href="{{ route('candidatures.fichier', $candidature->id) }}?path={{ urlencode($l->fichier_certificat) }}" target="_blank">📄</a>
                                @endif
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($candidature->projetsRecherche->count())
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Projet de recherche</h5>
                        @foreach($candidature->projetsRecherche as $p)
                            <strong>{{ $p->titre }}</strong> {{ $p->discipline ? '— '.$p->discipline : '' }}
                            <p class="small">{{ $p->resume }}</p>
                            @if($p->fichier_projet)
                                <a href="{{ route('candidatures.fichier', $candidature->id) }}?path={{ urlencode($p->fichier_projet) }}" target="_blank" class="btn btn-sm btn-outline-secondary">📄 Fichier du projet</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            @if($candidature->lettreMotivation)
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Lettre de motivation</h5>
                        <p class="small">{{ $candidature->lettreMotivation->contenu ?? '-' }}</p>
                        @if($candidature->lettreMotivation->fichier)
                            <a href="{{ route('candidatures.fichier', $candidature->id) }}?path={{ urlencode($candidature->lettreMotivation->fichier) }}" target="_blank" class="btn btn-sm btn-outline-secondary">📄 Lettre signée</a>
                        @endif
                    </div>
                </div>
            @endif

            @if($candidature->documents->count())
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Documents joints</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($candidature->documents as $doc)
                                <a href="{{ route('candidatures.document', [$candidature->id, $doc->id]) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-file-earmark"></i> {{ $doc->type_document }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
</x-layouts.main>
