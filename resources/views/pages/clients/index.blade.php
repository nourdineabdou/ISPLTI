<x-layouts.main
    :title="$title"
    :actions="$actions"
>
    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table
                    class="table table-striped table-bordered w-100"
                    data-url="{{ route('clients.index') }}"
                    data-column='nom,type,phone,email,adresse,action'
                >
                    <thead>
                    <tr>
                        <td>{{ __("client.nom") }}</td>
                        <td>{{ __("client.type") }}</td>
                        <td>{{ __("client.phone") }}</td>
                        <td>{{ __("client.email") }}</td>
                        <td>{{ __("client.adresse") }}</td>
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
