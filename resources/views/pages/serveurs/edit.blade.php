<x-modal-header-body
    title="Modifier un serveur"
>
    <div id="edit-serveur-form">
        <form action="{{ route('serveurs.update', $serveur->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    name="name"
                    label="Nom"
                    required="true"
                    value="{{ $serveur->name }}"
                />
                <x-forms.input
                    class="col-md-6"
                    name="phone"
                    label="Téléphone"
                    required="true"
                    value="{{ $serveur->phone }}"
                />
            </div>
            <x-buttons.save
                container="edit-serveur-form"
                onclick="saveForm({element: this})"
            />
        </form>
    </div>
</x-modal-header-body>
