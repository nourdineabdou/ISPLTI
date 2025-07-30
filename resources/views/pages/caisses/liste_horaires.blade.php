<x-layouts.main
    :title="$title"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('caisses.horaire') }}"
                    data-column='nom,horaire,user,montant,nombre,etat,action'>
                    <thead>
                    <tr>
                        <td>{{ __("caisses.nom") }}</td>
                        <td>{{ __("caisses.horaire") }}</td>
                        <td>{{ __("caisses.user") }}</td>
                        <td>{{ __("caisses.montant") }}</td>
                        <td>{{ __("caisses.nb_ordre") }}</td>
                        <td>{{ __("caisses.etat") }}</td>
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
