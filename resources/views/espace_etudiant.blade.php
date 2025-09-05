<x-layouts.main
    :title="__('Dashboard Étudiant')"
>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets-lib/img/photos/'.$ndos.'.jpg') }}" alt="Photo étudiant.." class="rounded-circle shadow" width="80" height="80">
            </div>
            <div class="col-md-10">
                <h2 class="mb-1">Bienvenue <span class="text-primary"> {{$etudiant->nom_fr}}</span></h2>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">@lang('system.num_inscription') </span>
                    <span class="badge bg-success">{{ $etudiant->nodos }}</span>
                </div>
                <div class="mb-1">
                     <span class="me-2">@lang('system.statit_inscription') </span>
                    <span class="badge bg-success">
                        @if ($inscritEtat==1)
                            ✅ @lang('system.valide') 
                           
                        @else
                            ❌ @lang('system.noninscrit')
                        @endif
                    </span> 
                    @if ($inscritEtat==1) 
                     <a class="navbar-brand" href="">@lang('system.imprimerATTESTATIONiNSCRIPTION') </a>
                    @endif
                </div>
                 
                <div>
                    <span class="me-2">@lang('system.anneeAcademique') </span>
                    <span class="fw-bold">{{$anneeActive->annee_univ_id}}</span>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-week"></i>  @lang('system.suvidepresence') </h5>
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
                                <th>Observation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-week"></i> @lang('system.emploidetemps')</h5>
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
                <h5 class="mb-0"><i class="bi bi-calendar-week"></i>  @lang('system.resultats') </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th> @lang('system.semestre')</th>
                                
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

    </div>
</x-layouts.main>
