<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('etudiants.index') }}"
                    data-column='nom_fr,lieu_naissance_fr,date_naissance,telephone,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("etudiants.nom") }}</td>
                        <td>{{ __("etudiants.lieu_naissance") }}</td>
                        <td>{{ __("etudiants.date_naissance") }}</td>
                        <td>{{ __("etudiants.telephone") }}</td>
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
