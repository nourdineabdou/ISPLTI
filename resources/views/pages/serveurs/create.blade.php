<x-modal-header-body
    title="Ajouter un serveur"
>
    <div id="create-serveur-form">
        <form action="{{ route('serveurs.store') }}" method="POST">
            @csrf
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    name="name"
                    label="Nom"
                    required="true"
                />
                <x-forms.input
                    class="col-md-6"
                    name="phone"
                    label="Téléphone"
                    required="true"
                />
            </div>
            <x-buttons.save
                container="create-serveur-form"
                onclick="saveForm({element: this})"
            />
        </form>
    </div>
</x-modal-header-body>
