<x-layouts.main
    :title="__('Dashboard Étudiant')"
>
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/student_avatar.png') }}" alt="Photo étudiant" class="rounded-circle shadow" width="80" height="80">
            </div>
            <div class="col-md-10">
                <h2 class="mb-1">Bienvenue <span class="text-primary">Ahmed Ould Mohamed</span></h2>
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2">Statut d’inscription :</span>
                    <span class="badge bg-success">✅ Validée</span>
                </div>
                <div class="mb-1">
                    <span class="me-2">Dernière connexion :</span>
                    <span class="fw-bold">04/08/2025 09:15</span>
                </div>
                <div>
                    <span class="me-2">Année scolaire active :</span>
                    <span class="fw-bold">2024-2025</span>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-calendar-week"></i> Emploi du temps</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Jour</th>
                                <th>Heure</th>
                                <th>Matière</th>
                                <th>Salle</th>
                                <th>Enseignant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lundi</td>
                                <td>08:00 - 10:00</td>
                                <td>Mathématiques</td>
                                <td>B101</td>
                                <td>M. Diallo</td>
                            </tr>
                            <tr>
                                <td>Mardi</td>
                                <td>10:15 - 12:15</td>
                                <td>Physique</td>
                                <td>B102</td>
                                <td>Mme Sow</td>
                            </tr>
                            <tr>
                                <td>Mercredi</td>
                                <td>14:00 - 16:00</td>
                                <td>Français</td>
                                <td>B103</td>
                                <td>M. Ba</td>
                            </tr>
                            <tr>
                                <td>Jeudi</td>
                                <td>08:00 - 10:00</td>
                                <td>Anglais</td>
                                <td>B104</td>
                                <td>Mme Kane</td>
                            </tr>
                            <tr>
                                <td>Vendredi</td>
                                <td>10:15 - 12:15</td>
                                <td>Informatique</td>
                                <td>B105</td>
                                <td>M. Sy</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
