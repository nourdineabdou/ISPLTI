<x-layouts.main
    :title="$title"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('caisses.horaire') }}"
                    data-column='caissier,nom,date,horaire,etat,montant,nombre,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("caissier") }}</td>
                        <td>{{ __("Nom caisse") }}</td>
                        <td>{{ __("caisses.horaire") }}</td>
                        <td>{{ __("Shift") }}</td>
                        <td>{{ __("caisses.etat") }}</td>
                        <td>{{ __("caisses.montant") }}</td>
                        <td>{{ __("Nb de commande") }}</td>
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
