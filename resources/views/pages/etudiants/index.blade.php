<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card datatable-container">
        <div class="card-header">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label for="inscription_filter">{{ __("etudiants.etat_inscription") }}</label>
                    <select
                        id="inscription_filter"
                        name="inscription_filter"
                        class="form-control select2"
                        data-filter="inscription"
                    >
                        <option value="">Tous</option>
                        <option value="3">En attente</option>
                        <option value="2">Dossier reçu</option>
                        <option value="1">Validé</option>
                        <option value="4">Rejeté</option>
                        <option value="0">Non soumis</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('etudiants.index') }}"
                    data-column='nodos,nom_fr,lieu_naissance_fr,date_naissance,telephone,inscription,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("etudiants.nodos") }}</td>
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
