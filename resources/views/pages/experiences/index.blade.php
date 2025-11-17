<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('experiences.index') }}"
                    data-column='job_title,institution,start_date,end_date,responsibilities,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("experiences.job_title") }}</td>
                        <td>{{ __("experiences.institution") }}</td>
                        <td>{{ __("experiences.start_date") }}</td>
                        <td>{{ __("experiences.end_date") }}</td>
                        <td>{{ __("experiences.responsibilities") }}</td>
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
