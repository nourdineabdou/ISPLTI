<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Étudiant - {{ $etudiant->nom_fr ?? $etudiant->nom ?? 'ISPLTI' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    <style>
        :root {
            --primary-color: #1a365d;
            --secondary-color: #667eea;
            --accent-color: #764ba2;
            --light-bg: #f8fafc;
            --border-radius: 15px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .main-container {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        .header-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2c5282 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .header-section::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
        }

        .student-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            margin: 0 auto 1rem;
            overflow: hidden;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .student-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .student-avatar .placeholder {
            color: rgba(255,255,255,0.8);
            font-size: 2rem;
        }

        .info-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .info-card .card-header {
            background: linear-gradient(135deg, var(--light-bg) 0%, #e2e8f0 100%);
            border-bottom: 3px solid var(--secondary-color);
            font-weight: 600;
            color: var(--primary-color);
        }

        .info-item {
            border-left: 4px solid var(--secondary-color);
            background: var(--light-bg);
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            border-left-color: var(--accent-color);
            background: #e8f4fd;
        }

        .btn-custom-primary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }

        .btn-custom-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-custom-secondary {
            background: white;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-custom-secondary:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .badge-status {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary-color), var(--accent-color));
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            body { padding: 10px; }
            .header-section { padding: 1.5rem 1rem; }
            .student-avatar { width: 100px; height: 100px; }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="main-container">
                    <!-- Header Section -->
                    <div class="header-section">
                        <div class="student-avatar">
                            @if(!empty($etudiant->id))
                                <img src="{{ route('etudiants.image', $etudiant->id) }}" alt="Photo {{ $etudiant->nom_fr ?? $etudiant->nom }}">
                            @else
                                <div class="placeholder">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                            @endif
                        </div>
                        <h1 class="h2 mb-2 fw-bold">{{ $etudiant->nom_fr ?? ($etudiant->nom ?? 'Nom non renseigné') }}</h1>
                        <p class="mb-0 opacity-75">Institut Supérieur Professionnel de Langues, de Traduction & d'Interprétariat</p>
                        <span class="badge-status mt-3 d-inline-block">
                            <i class="bi bi-check-circle me-1"></i>Étudiant inscrit
                        </span>
                    </div>

                    <!-- Content Section -->
                    <div class="p-4">
                        <div class="row">
                            <!-- Informations personnelles -->
                            <div class="col-12 col-lg-8">
                                <h3 class="section-title">
                                    <i class="bi bi-person-lines-fill me-2"></i>Informations personnelles
                                </h3>

                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="info-item p-3 rounded">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-geo-alt-fill text-primary me-2 fs-5"></i>
                                                <div>
                                                    <small class="text-muted text-uppercase fw-semibold">Lieu de naissance</small>
                                                    <div class="fw-bold">{{ $etudiant->lieu_naissance_fr ?? ($etudiant->lieu_naissance ?? 'Non renseigné') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="info-item p-3 rounded">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar-event text-primary me-2 fs-5"></i>
                                                <div>
                                                    <small class="text-muted text-uppercase fw-semibold">Date de naissance</small>
                                                    <div class="fw-bold">
                                                        {{ !empty($etudiant->date_naissance) ? \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') : 'Non renseigné' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="info-item p-3 rounded">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-telephone-fill text-primary me-2 fs-5"></i>
                                                <div>
                                                    <small class="text-muted text-uppercase fw-semibold">Téléphone</small>
                                                    <div class="fw-bold">{{ $etudiant->telephone ?? 'Non renseigné' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="info-item p-3 rounded">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-card-text text-primary me-2 fs-5"></i>
                                                <div>
                                                    <small class="text-muted text-uppercase fw-semibold">Numéro d'inscription</small>
                                                    <div class="fw-bold">{{ $etudiant->nodos}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="info-item p-3 rounded">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-mortarboard-fill text-primary me-2 fs-5"></i>
                                                <div>
                                                    <small class="text-muted text-uppercase fw-semibold">Niveau d'inscription</small>
                                                    <div class="fw-bold">{{ $niveau }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Statistiques et actions -->
                            <div class="col-12 col-lg-4">
                                <h3 class="section-title">
                                    <i class="bi bi-bar-chart-fill me-2"></i>Statut
                                </h3>

                                <div class="stats-card mb-4">
                                    <i class="bi bi-award fs-1 mb-3 d-block"></i>
                                    <h5 class="mb-2">Étudiant Actif</h5>
                                    <p class="mb-0 opacity-75">Inscription validée pour l'année {{ date('Y') }}-{{ date('Y')+1 }}</p>
                                </div>

                                <div class="card info-card">
                                    <div class="card-header">
                                        <i class="bi bi-tools me-2"></i>Actions rapides
                                    </div>
                                    <div class="card-body">
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('etudiants.attestation', $etudiant->id) }}" target="_blank" class="btn btn-custom-warning">
                                                <i class="bi bi-file-earmark-pdf me-2"></i>Imprimer l'attestation
                                            </a>
                                            <a href="#" class="btn btn-custom-secondary">
                                                <i class="bi bi-pencil-square me-2"></i>Modifier le profil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
