<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('caisses.index') }}"
                    data-column='nom,montant,user,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("caisses.nom") }}</td>
                        <td>{{ __("caisses.montant") }}</td>
                        <td>{{ __("caisses.user") }}</td>
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
