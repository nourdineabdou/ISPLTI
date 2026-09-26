<x-layouts.main
    :title="$title"
>
    <div class="card datatable-container">
        <div class="card-header">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label for="statut_filter">Statut</label>
                    <select
                        id="statut_filter"
                        name="statut_filter"
                        class="form-control select2"
                        data-filter="statut"
                    >
                        <option value="">Tous</option>
                        <option value="brouillon">Brouillon</option>
                        <option value="soumis">Soumis</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('candidatures.index') }}"
                    data-column='numero_candidature,nom,prenom,master,email,statut,action'
                >
                    <thead>
                    <tr>
                        <td>N°</td>
                        <td>Nom</td>
                        <td>Prénom</td>
                        <td>Master</td>
                        <td>Email</td>
                        <td>Statut</td>
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
