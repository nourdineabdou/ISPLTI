<x-layouts.main
    :title="$title"
>
    <div class="card datatable-container">
        <div class="card-header">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <x-forms.select
                        label="Statut"
                        name="statut_filter"
                        :options=['' => 'Tous', 'brouillon' => 'Brouillon', 'soumis' => 'Soumis']
                        data-filter="statut"
                        select-class="select2"
                    />
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
