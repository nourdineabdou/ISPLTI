<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absences de l'étudiant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #e0e7ff 0%, #f8fafc 100%);
            min-height: 100vh;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(26,54,93,0.12);
        }
        .rounded-circle {
            border: 3px solid #6366f1;
        }
        .table th, .table td {
            vertical-align: middle;
            font-size: 1rem;
        }
        .badge.bg-gradient-primary {
            background: linear-gradient(90deg,#6366f1,#4f46e5);
        }
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem !important;
            }
            .d-flex.align-items-center {
                flex-direction: column !important;
                text-align: center;
            }
            .rounded-circle {
                margin-bottom: 1rem;
            }
            .table th, .table td {
                font-size: 0.95rem;
                padding: 0.5rem;
            }
        }
        @media (max-width: 576px) {
            .container {
                padding: 0 2px;
            }
            .card {
                margin: 0;
            }
            .table-responsive {
                overflow-x: auto;
            }
            .table th, .table td {
                font-size: 0.9rem;
                padding: 0.35rem;
            }
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ url('/etudiants/image/' . $etudiant->id) }}" alt="Photo {{ $etudiant->nom_fr ?? $etudiant->nom }}" class="rounded-circle me-3" style="width:80px;height:80px;object-fit:cover;box-shadow:0 4px 16px rgba(26,54,93,0.12);">
                        <div>
                            <h3 class="mb-0">{{ $etudiant->nom_fr  }}</h3>
                            <div class="text-muted">N° DOS: {{ $etudiant->nodos ?? '-' }}</div>
                        </div>
                    </div>
                    <h5 class="mb-3 text-primary"><i class="bi bi-calendar-x me-2"></i>Absences enregistrées</h5>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Matricule</th>
                                    <th>Jour</th>
                                    <th>Matière</th>
                                    <th>Spécialité</th>
                                    <th>Semestre</th>
                                    <th>Horaire</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absences as $absence)
                                    <tr>
                                        <td>{{ $absence->matrucle ?? '-' }}</td>
                                        <td>{{ $absence->jour ?? '-' }}</td>
                                        <td>{{ $absence->matiere ?? '-' }}</td>
                                        <td>{{ $absence->specialite ?? '-' }}</td>
                                        <td>{{ $absence->semestre ?? '-' }}</td>
                                        <td>{{ $absence->horaire ?? '-' }}</td>
                                        <td><span class="badge bg-gradient-primary text-white">{{ $absence->date ? \Carbon\Carbon::parse($absence->date)->format('d/m/Y') : '-' }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">Aucune absence enregistrée pour cet étudiant.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
