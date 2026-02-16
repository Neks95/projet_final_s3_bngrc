<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Don - BNGRC</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <div class="logo">BNGRC</div>
                    <span>Gestion des Dons</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="villes.html">Villes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="besoins.html">Besoins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dons.html">Dons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="attributions.html">Attributions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="simulation.html">Simulation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="rapports.html">Rapports</a>
                        </li>
                    </ul>
                    <div class="ms-3 text-white small" id="current-datetime"></div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="dons.html">Dons</a></li>
                    <li class="breadcrumb-item active">Détails</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Détails du Don</h1>
                    <p class="text-muted">Informations complètes sur le don</p>
                </div>
                <div>
                    <a href="don-modifier.html" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="dons.html" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>

            <!-- Informations du Don -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-custom mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-gift"></i> Informations du Don</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Type de Don :</strong>
                                    <p class="text-muted">Riz</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Statut :</strong>
                                    <p><span class="badge bg-success">Distribué</span></p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <strong>Quantité :</strong>
                                    <p class="text-muted">500 kg</p>
                                </div>
                                <div class="col-md-4">
                                    <strong>Valeur Unitaire :</strong>
                                    <p class="text-muted">2 500 Ar</p>
                                </div>
                                <div class="col-md-4">
                                    <strong>Valeur Totale :</strong>
                                    <p class="text-primary fw-bold">1 250 000 Ar</p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Donateur :</strong>
                                    <p class="text-muted">ONG Croix Rouge</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Organisation :</strong>
                                    <p class="text-muted">Organisation Non Gouvernementale</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Date du Don :</strong>
                                    <p class="text-muted">15/02/2026</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Date d'enregistrement :</strong>
                                    <p class="text-muted">15/02/2026 - 10:30</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong>Notes :</strong>
                                <p class="text-muted">Don reçu en excellent état. Distribution effectuée à Toamasina pour les victimes du cyclone.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Historique des Attributions -->
                    <div class="card shadow-custom mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="bi bi-list-check"></i> Historique des Attributions</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ville</th>
                                            <th>Quantité Attribuée</th>
                                            <th>Valeur</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>16/02/2026</td>
                                            <td>Toamasina</td>
                                            <td>300 kg</td>
                                            <td>750 000 Ar</td>
                                            <td><span class="badge bg-success">Distribué</span></td>
                                        </tr>
                                        <tr>
                                            <td>17/02/2026</td>
                                            <td>Mananjary</td>
                                            <td>200 kg</td>
                                            <td>500 000 Ar</td>
                                            <td><span class="badge bg-success">Distribué</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="table-active">
                                            <td colspan="2"><strong>Total Distribué</strong></td>
                                            <td><strong>500 kg</strong></td>
                                            <td><strong>1 250 000 Ar</strong></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Traçabilité -->
                    <div class="card shadow-custom mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="bi bi-clock-history"></i> Traçabilité</h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <strong>17/02/2026 - 14:30</strong>
                                        <p class="text-muted mb-0">Distribution complétée à Mananjary (200 kg)</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-success"></div>
                                    <div class="timeline-content">
                                        <strong>16/02/2026 - 09:15</strong>
                                        <p class="text-muted mb-0">Distribution complétée à Toamasina (300 kg)</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-info"></div>
                                    <div class="timeline-content">
                                        <strong>15/02/2026 - 16:00</strong>
                                        <p class="text-muted mb-0">Don attribué aux villes de Toamasina et Mananjary</p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <strong>15/02/2026 - 10:30</strong>
                                        <p class="text-muted mb-0">Don enregistré dans le système</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card shadow-custom mb-4">
                        <div class="card-body text-center">
                            <div class="display-4 text-primary mb-2">
                                <i class="bi bi-gift-fill"></i>
                            </div>
                            <h5 class="card-title">Don #00001</h5>
                            <span class="badge bg-success fs-6">Distribué</span>
                        </div>
                    </div>

                    <div class="card shadow-custom mb-4 bg-light">
                        <div class="card-body">
                            <h6 class="card-title"><i class="bi bi-calculator"></i> Résumé</h6>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Valeur Totale :</span>
                                <strong>1 250 000 Ar</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Quantité Totale :</span>
                                <strong>500 kg</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Attribué :</span>
                                <strong class="text-success">500 kg (100%)</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Reste :</span>
                                <strong class="text-muted">0 kg</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-custom mb-4">
                        <div class="card-body">
                            <h6 class="card-title"><i class="bi bi-person-badge"></i> Contact Donateur</h6>
                            <hr>
                            <p class="mb-1"><strong>Nom :</strong></p>
                            <p class="text-muted">ONG Croix Rouge</p>
                            <p class="mb-1"><strong>Organisation :</strong></p>
                            <p class="text-muted">Organisation Non Gouvernementale</p>
                            <p class="mb-1"><strong>Type :</strong></p>
                            <p class="text-muted">ONG Internationale</p>
                        </div>
                    </div>

                    <div class="card shadow-custom">
                        <div class="card-body">
                            <h6 class="card-title"><i class="bi bi-tools"></i> Actions</h6>
                            <hr>
                            <div class="d-grid gap-2">
                                <a href="don-modifier.html" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <button class="btn btn-info" onclick="window.print()">
                                    <i class="bi bi-printer"></i> Imprimer
                                </button>
                                <button class="btn btn-danger" onclick="handleDelete('don', 1)">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>BNGRC</h5>
                    <p>Bureau National de Gestion des Risques et des Catastrophes</p>
                    <p>&copy; 2026 BNGRC. Tous droits réservés.</p>
                </div>
                <div class="col-md-3">
                    <h5>Liens Utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Aide</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <p>Email: contact@bngrc.gov.mg<br>
                    Tél: +261 20 XX XXX XX</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="js/app.js"></script>
    
    <!-- Page-specific styles for timeline -->
    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 8px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }
        
        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }
        
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        
        .timeline-marker {
            position: absolute;
            left: -26px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid #fff;
        }
        
        .timeline-content strong {
            display: block;
            color: #495057;
            margin-bottom: 4px;
        }
    </style>
</body>
</html>
