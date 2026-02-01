<x-layouts.main
    :title="__('Dashboard Étudiant')"
>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                {{-- getImage --}}
                <img src="{{ route('etudiants.image', $etudiant->id) }}" alt="Photo étudiant.." class="rounded-circle shadow" width="80" height="80">
            </div>
            <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h2 class="mb-0">Bienvenue <span class="text-primary"> {{$etudiant->nom_fr}}</span></h2>
                    <a class="btn btn-success btn-sm px-3 py-2 shadow-sm d-inline-flex align-items-center w-100 w-md-auto text-center"
                       style="font-size:1rem;gap:0.5rem;max-width:320px;min-width:150px;white-space:normal;"
                       onclick="printObject({link:'{{ route('etudiants.convocation', $etudiant->id) }}', title:'Convocation', width:8.27, height:11.7})"
                       target="_blank">
                        <i class="bi bi-download"></i> <span>Télécharger la convocation</span>
                    </a>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">@lang('etudiants.num_inscription') </span>
                    <span class="badge bg-success">{{ $etudiant->nodos }}</span>
                </div>
                <div class="mb-1">
                     <span class="me-2">@lang('etudiants.statut_inscription') </span>
                    <span class="badge bg-success">
                        @if ($inscritEtat==1)
                            ✅ @lang('etudiants.valide')

                        @else
                            ❌ @lang('etudiants.noninscrit')
                        @endif
                    </span>
                    @if ($inscritEtat==1)
                     <a class="navbar-brand" onclick="printObject({link:'{{ route('etudiants.attestation', $etudiant->id) }}' , title:'Attestation dinscription'  , width:4 , height:4})" target="_blank" class="btn btn-success btn-lg">@lang('etudiants.imprimerATTESTATIONiNSCRIPTION') </a>
                    @endif
                </div>

                <div>
                    <span class="me-2">@lang('etudiants.anneeAcademique') </span>
                    <span class="fw-bold">{{$anneeActive->annee_univ_id}}</span>
                </div>
            </div>
        </div>

        {{-- programmes --}}
        @php
            $programes = \App\Models\Programme::where('matrucle', $etudiant->nodos)->orderBy('date', 'asc')->get();
        @endphp
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0 fw-bold"><i class="bi bi-journal-bookmark"></i> @lang('etudiants.programmes')</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Matricule</th>
                                <th>Jour</th>
                                <th>Matière</th>
                                <th>Spécialité</th>
                                <th>Semestre</th>
                                <th>Semaine</th>
                                <th>Horaire</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($programes as $programme)
                                <tr>
                                    <td>{{ $programme->matrucle }}</td>
                                    <td>{{ $programme->jour  }}</td>
                                    <td>{{ $programme->matiere }}</td>
                                    <td>{{ $programme->specialite }}</td>
                                    <td>{{ $programme->semestre }}</td>
                                    <td>{{ $programme->semaine  }}</td>
                                    <td>{{ $programme->horaire  }}</td>
                                    <td><span class="badge bg-gradient-secondary text-white">{{ $programme->date  }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Aucun programme trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- suivi absences --}}

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-2 mb-md-0"><i class="bi bi-calendar-week"></i>  @lang('etudiants.suvidabecence')</h5>
            </div>
        @php
             $absences = \App\Models\Absence::where('matrucle', $etudiant->nodos)->get();
        @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Matricule</th>
                                <th>Jour</th>
                                <th>Matière</th>
                                <th>Spécialité</th>
                                <th>Semestre</th>
                                <th>Horaire</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absences as $absence)
                            <tr>
                                <td>{{ $absence->matrucle }}</td>
                                <td>{{ $absence->jour }}</td>
                                <td>{{ $absence->matiere }}</td>
                                <td>{{ $absence->specialite }}</td>
                                <td>{{ $absence->semestre }}</td>
                                <td>{{ $absence->horaire }}</td>
                                <td><span class="badge bg-gradient-primary text-white">{{ $absence->date ? \Carbon\Carbon::parse($absence->date)->format('d/m/Y') : '-' }}</span></td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        {{--
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-week"></i> @lang('etudiants.emploidetemps')</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Jour</th>
                                <th>Heure</th>
                                <th>Matière</th>
                                <th>Salle</th>
                                <th>Enseignant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lundi</td>
                                <td>08:00 - 10:00</td>
                                <td>Mathématiques</td>
                                <td>B101</td>
                                <td>M. Diallo</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-week"></i>  @lang('etudiants.resultats') </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th> @lang('etudiants.semestre')</th>

                                <th>Observation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        --}}

    </div>
</x-layouts.main>
