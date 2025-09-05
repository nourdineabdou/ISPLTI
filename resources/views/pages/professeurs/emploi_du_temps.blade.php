<x-layouts.main
    :title="$title"
>
 <div id="create-emploi-du-temps-form">
    <form
        action="{{ route('professeurs.emploi_du_temps_store') }}"
        method="POST"
        id="create-emploi-du-temps-form"
        class="form"
    >
        @csrf
        <div class="row">
            {{-- professeur_id x-select --}}
            <x-forms.select
                class="col-md-6"
                label="Professeur"
                name="professeur_id"
                :options="$professeurs"
                required="required"
            />
            {{-- annee_id x-select --}}
            <x-forms.select
                class="col-md-6"
                label="Année"
                name="annee_id"
                :options="$annees"
                required="required"
                labelField="libelle_ann_univ_ar"
            />
            {{-- emplacement x-input --}}
            <x-forms.input
                class="col-md-12"
                label="Emplacement"
                name="emplacement"
                type="file"
                required="required"
                value="{{ old('emplacement') }}"
                {{-- accès que les photos --}}
                accept="image/*"
            />
        </div>
        <x-buttons.save
            container="create-emploi-du-temps-form"
            onclick="saveForm({ element: this  })"
        />
    </form>
 </div>
</x-layouts.main>
