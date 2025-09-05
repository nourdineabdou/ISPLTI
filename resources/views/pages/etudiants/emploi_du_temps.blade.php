<x-layouts.main
    :title="$title"
>
 <div id="create-emploi-du-temps-form">
    <form
        action="{{ route('etudiants.emploi_du_temps_store') }}"
        method="POST"
        id="create-emploi-du-temps-form"
        class="form"
    >
        @csrf
        <div class="row">
            {{-- specialite_id x-select --}}
            <x-forms.select
                class="col-md-6"
                label="specialité"
                name="specialite_id"
                :options="$specialites"
                required="required"
                labelField="lib_annee_diplome_fr"
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
            {{-- semestre_id x-select --}}
            <x-forms.select
                class="col-md-6"
                label="Semestre"
                name="semestre_id"
                :options="$semestres"
                required="required"
                labelField="lib_semestre_fr"
            />
            {{-- emplacement x-input --}}
            <x-forms.input
                class="col-md-6"
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
