<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('formations.index') }}"
                    data-column='degree,institution,start_year,end_year,description,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("formations.degree") }}</td>
                        <td>{{ __("formations.institution") }}</td>
                        <td>{{ __("formations.start_year") }}</td>
                        <td>{{ __("formations.end_year") }}</td>
                        <td>{{ __("formations.description") }}</td>
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
