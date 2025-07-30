<x-layouts.main
    title="Liste des serveurs"
    :actions="[
         [
            'label' => 'Ajouter un serveur',
            'onclick' => 'openInModal({ link: \'' . route('serveurs.create') . '\' })',
            'permission' => 'serveur-create'
        ]
    ]"
>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover w-100 responsive"
                   data-url="{{ route('serveurs.index') }}"
                   data-column="id,name,phone,actions"
            >
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('server.name') }}</th>
                    <th>{{ __('server.phone') }}</th>
                    <th>{{ __('server.actions') }}</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</x-layouts.main>
