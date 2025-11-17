<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('languages.index') }}"
                    data-column='language,niveau,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("languages.language") }}</td>
                        <td>{{ __("languages.niveau") }}</td>
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
