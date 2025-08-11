
<x-layouts.main :title="'Tableau de bord administrateur'">
    <div class="container py-4">
        <h2 class="mb-4">Tableau de bord</h2>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Étudiants</h5>
                        <p class="display-5 fw-bold text-primary">1 245</p>
                        <span class="text-muted">Nombre total d’étudiants</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Professeurs</h5>
                        <p class="display-5 fw-bold text-success">87</p>
                        <span class="text-muted">Nombre total de professeurs</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Cours</h5>
                        <p class="display-5 fw-bold text-warning">52</p>
                        <span class="text-muted">Nombre de cours</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Sessions à venir</h5>
                        <p class="display-5 fw-bold text-info">4</p>
                        <span class="text-muted">Prochaines sessions</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Courbe des inscriptions (2025)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="inscriptionsChart" height="120"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Notifications</h5>
                    </div>
                    <div class="card-body" style="max-height: 250px; overflow-y: auto;">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nouvel étudiant inscrit : <b>Fatou Sow</b></li>
                            <li class="list-group-item">Nouveau document ajouté : <b>Règlement intérieur.pdf</b></li>
                            <li class="list-group-item">Absence signalée : <b>Mohamed Ba</b> (Mathématiques)</li>
                            <li class="list-group-item">Session à venir : <b>Anglais - 10/08/2025</b></li>
                            <li class="list-group-item">Nouveau professeur : <b>Mme Kane</b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Prochaines sessions / Emplois du temps</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Cours</th>
                                <th>Salle</th>
                                <th>Professeur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10/08/2025</td>
                                <td>08:00 - 10:00</td>
                                <td>Anglais</td>
                                <td>B104</td>
                                <td>Mme Kane</td>
                            </tr>
                            <tr>
                                <td>11/08/2025</td>
                                <td>10:15 - 12:15</td>
                                <td>Mathématiques</td>
                                <td>B101</td>
                                <td>M. Diallo</td>
                            </tr>
                            <tr>
                                <td>12/08/2025</td>
                                <td>14:00 - 16:00</td>
                                <td>Physique</td>
                                <td>B102</td>
                                <td>Mme Sow</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN for the courbe -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août'],
                datasets: [{
                    label: 'Inscriptions',
                    data: [120, 150, 180, 200, 250, 300, 320, 340],
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0,123,255,0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</x-layouts.main>
