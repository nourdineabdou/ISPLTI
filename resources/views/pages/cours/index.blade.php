<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('mescours.index') }}"
                    data-column='matiere_id,specialite_id,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("cours.matiere") }}</td>
                        <td>{{ __("cours.specialite") }}</td>
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
