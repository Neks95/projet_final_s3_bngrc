<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Attribution - BNGRC</title>
    
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
                    <li class="breadcrumb-item"><a href="attributions.html">Attributions</a></li>
                    <li class="breadcrumb-item active">Détails</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Détails de l'Attribution</h1>
                    <p class="text-muted">Informations complètes sur l'attribution</p>
                </div>
                <div>
                    <button class="btn btn-danger" onclick="handleDelete('attribution', 1)">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                    <a href="attributions.html" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>

            <!-- Informations de l'Attribution -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-custom mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-share"></i> Informations de l'Attribution</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Date d'Attribution :</strong>
                                    <p class="text-muted">15 Février 2026</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Statut :</strong>
                                    <p><span class="badge bg-success">Livré</span></p>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Type de Don :</strong>
                                    <p class="text-muted">Riz</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Quantité Attribuée :</strong>
                                    <p class="text-muted">300 kg</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <strong>Valeur de l'Attribution :</strong>
                                    <p class="text-muted fs-5 text-success fw-bold">750 000 Ar</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Notes :</strong>
                                    <p class="text-muted">Attribution urgente suite aux inondations. Distribution effectuée en coordination avec les autorités locales.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Don Source -->
                    <div class="card shadow-custom mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="bi bi-gift"></i> Don Source</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Type :</strong>
                                    <p class="text-muted">Riz</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Quantité Totale du Don :</strong>
                                    <p class="text-muted">500 kg</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Donateur :</strong>
                                    <p class="text-muted">ONG Croix Rouge</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Date du Don :</strong>
                                    <p class="text-muted">15 Février 2026</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Valeur Totale du Don :</strong>
                                    <p class="text-muted">1 250 000 Ar</p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="don-details.html" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Voir les Détails du Don
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Ville Bénéficiaire -->
                    <div class="card shadow-custom mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Ville Bénéficiaire</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Ville :</strong>
                                    <p class="text-muted">Toamasina</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Région :</strong>
                                    <p class="text-muted">Atsinanana</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Population :</strong>
                                    <p class="text-muted">315 000 habitants</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Personnes Affectées :</strong>
                                    <p class="text-muted">8 500 personnes</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Niveau de Gravité :</strong>
                                    <p><span class="badge bg-danger">Très élevé</span></p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="ville-details.html" class="btn btn-sm btn-warning">
                                    <i class="bi bi-eye"></i> Voir les Détails de la Ville
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar - Analyse d'Impact -->
                <div class="col-lg-4">
                    <div class="card shadow-custom mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-graph-up"></i> Analyse d'Impact</h5>
                        </div>
                        <div class="card-body">
                            <h6 class="mb-3">Couverture des Besoins</h6>
                            
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small">Besoin de Riz</span>
                                    <span class="small fw-bold">500 kg</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="small">Quantité attribuée</span>
                                    <span class="small fw-bold">300 kg</span>
                                </div>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">60%</div>
                                </div>
                                <p class="small text-muted mt-2">Cette attribution couvre <strong>60%</strong> du besoin en Riz de Toamasina</p>
                            </div>

                            <hr>

                            <h6 class="mb-3">Impact Estimé</h6>
                            <ul class="small mb-0">
                                <li class="mb-2"><strong>Bénéficiaires directs :</strong> ~5 100 personnes</li>
                                <li class="mb-2"><strong>Durée estimée :</strong> 3-4 jours</li>
                                <li class="mb-2"><strong>Valeur par personne :</strong> ~147 Ar</li>
                                <li class="mb-0"><strong>Priorité répondue :</strong> Alimentaire</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-custom">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="bi bi-clock-history"></i> Historique</h6>
                        </div>
                        <div class="card-body">
                            <ul class="timeline">
                                <li class="mb-2">
                                    <small class="text-muted">15/02/2026 14:30</small><br>
                                    <small><strong>Attribution créée</strong></small>
                                </li>
                                <li class="mb-2">
                                    <small class="text-muted">15/02/2026 15:15</small><br>
                                    <small><strong>En cours de livraison</strong></small>
                                </li>
                                <li>
                                    <small class="text-muted">15/02/2026 18:45</small><br>
                                    <small><strong>Livré et distribué</strong></small>
                                </li>
                            </ul>
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
</body>
</html>
