<x-modal-header-body
    :title="__('Temporaire de la ') . $caisse->nom"
>    <div id="edit-temporaire-form">
        <form
            action="{{ route('caisses.temporaire', $caisse) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <x-forms.input
                    class="col-md-6"
                    label="Journée"
                    name="journee"
                    required="required"
                    value="journée"
                />
                <x-forms.select
                    class="col-md-6"
                    label="Utilisateur"
                    name="user_journee"
                    required="required"
                    :options="$users"
                    :value="$journe_user_id"
                />
                <x-forms.input
                    class="col-md-6"
                    label="Soirée"
                    name="soiree"
                    required="required"
                    value="Soirée"
                />
                <x-forms.select
                    class="col-md-6"
                    label="Utilisateur"
                    name="user_soiree"
                    required="required"
                    :options="$users"
                    :value="$soire_user_id"
                />
            </div>
            <x-buttons.save
                container="edit-temporaire-form"
                onclick="saveForm({ element: this })"
            />
        </form>
    </div>
</x-modal-header-body>

