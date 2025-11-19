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
                <h2 class="mb-1">Bienvenue <span class="text-primary"> {{$etudiant->nom_fr}}</span></h2>
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

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-week"></i>  @lang('etudiants.suvidepresence') </h5>
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
