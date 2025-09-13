<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('actualites.index') }}"
                    data-column='titre_fr,titre_en,titre_ar,auteur,statut,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("actualites.titre_fr") }}</td>
                        <td>{{ __("actualites.titre_en") }}</td>
                        <td>{{ __("actualites.titre_ar") }}</td>
                        <td>{{ __("actualites.auteur") }}</td>
                        <td>{{ __("actualites.statut") }}</td>
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
