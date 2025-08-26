<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('professeurs.index') }}"
                    data-column='user,telephone,specialite,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("professeurs.nom") }}</td>
                        <td>{{ __("professeurs.telephone") }}</td>
                        <td>{{ __("professeurs.specialite") }}</td>
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
