
<x-layouts.main
    :title="__('Espace Professeur')"
>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body d-flex align-items-center">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Photo de profil" class="rounded-circle mr-4" width="100" height="100">
                    <div class="ml-4">
                        <h3 class="mb-1">M. Jean Dupont</h3>
                        <p class="mb-0 text-muted">Professeur de Mathématiques</p>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">Matières / Cours enseignés</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Mathématiques Générales</li>
                        <li class="list-group-item">Statistiques Appliquées</li>
                        <li class="list-group-item">Algèbre Linéaire</li>
                    </ul>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header bg-success text-white">Niveaux d’étude associés</div>
                <div class="card-body">
                    <span class="badge badge-info mr-2">Licence 1</span>
                    <span class="badge badge-info mr-2">Licence 2</span>
                    <span class="badge badge-info">Master 1</span>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-warning text-dark">Nombre total d’étudiants</div>
                <div class="card-body">
                    <h2 class="display-4">124</h2>
                    <p class="mb-0">Étudiants inscrits dans ses cours</p>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.main>
