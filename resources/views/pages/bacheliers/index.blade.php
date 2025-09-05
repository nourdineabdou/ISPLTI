<x-layouts.main
    :title="$title"
    :actions="$actions"
    >
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('bacheliers.index') }}"
                    data-column='num_bac,nni,nom_fr,lieun,datn,tel,etat_inscription,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("etudiants.num_bac") }}</td>
                        <td>{{ __("etudiants.nni") }}</td>
                        <td>{{ __("etudiants.nom") }}</td>
                        <td>{{ __("etudiants.lieu_naissance") }}</td>
                        <td>{{ __("etudiants.date_naissance") }}</td>
                        <td>{{ __("etudiants.telephone") }}</td>
                        <td>{{ __("etudiants.etat_inscription") }}</td>
                        <td>{{ __("system.action") }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.main>
