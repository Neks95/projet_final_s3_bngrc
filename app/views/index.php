<?php $base = Flight::get('flight.base_url'); ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BNGRC Gestion des Dons</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $base ?>css/style.css">
    <!-- Chart.js -->
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand">
                    <div class="logo">BNGRC</div>
                    <span>Gestion des Dons</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Villes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Besoins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Dons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Attributions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Simulation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">Rapports</a>
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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Tableau de Bord</h1>
                <p class="text-muted">Vue d'ensemble de la gestion des dons aux sinistrés</p>
            </div>

            <!-- Statistiques générales -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card card">
                        <div class="card-body">
                            <div class="stat-icon bg-primary text-white">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="stat-value">5</div>
                            <div class="stat-label">Villes Affectées</div>
                        </div>
                    </div>
                </div>
              
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card card">
                        <div class="card-body">
                            <div class="stat-icon bg-warning text-white">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="stat-value">45 680 000 Ar</div>
                            <div class="stat-label">Besoins Totaux</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stat-card card">
                        <div class="card-body">
                            <div class="stat-icon bg-success text-white">
                                <i class="bi bi-gift"></i>
                            </div>
                            <div class="stat-value">32 450 000 Ar</div>
                            <div class="stat-label">Dons Collectés</div>
                        </div>
                    </div>
                </div>
            </div>

         
               
            <!-- Tableau récapitulatif par ville -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0">Récapitulatif par Ville</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="villesTable">
                        <thead>
                            <tr>
                                <th class="sortable">Ville</th>
                                <th class="sortable">Besoins Totaux</th>
                                <th class="sortable">Dons Attribués</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Toamasina</strong></td>
                                <td>12 500 000 Ar</td>
                                <td>8 900 000 Ar</td>
                                <td>
                                    <a class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mananjary</strong></td>
                                <td>11 200 000 Ar</td>
                                <td>7 450 000 Ar</td>
                              
                                <td>
                                    <a class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mahanoro</strong></td>
                                <td>8 900 000 Ar</td>
                                <td>5 340 000 Ar</td>
                             
                                <td>
                                    <a class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Vatomandry</strong></td>
                                <td>7 580 000 Ar</td>
                                <td>4 200 000 Ar</td>
                               
                                <td>
                                    <a class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Brickaville</strong></td>
                                <td>5 500 000 Ar</td>
                                <td>2 000 000 Ar</td>
                                
                                <td>
                                    <a class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Détails
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Dernières activités -->
            <div class="row g-4 mt-2">
                <div class="col-lg-6">
                    <div class="activity-list">
                        <h4 class="mb-3">Derniers Dons Enregistrés</h4>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>ONG Croix Rouge</strong>
                                    <div class="text-muted">500 kg de Riz</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success">1 250 000 Ar</span>
                                    <div class="activity-date">15/02/2026</div>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Entreprise STAR</strong>
                                    <div class="text-muted">200 L d'Huile</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success">1 800 000 Ar</span>
                                    <div class="activity-date">14/02/2026</div>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>M. Rakoto Jean</strong>
                                    <div class="text-muted">Don financier</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success">500 000 Ar</span>
                                    <div class="activity-date">13/02/2026</div>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Association Vatosoa</strong>
                                    <div class="text-muted">100 Tôles</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success">2 500 000 Ar</span>
                                    <div class="activity-date">12/02/2026</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="activity-list">
                        <h4 class="mb-3">Dernières Attributions</h4>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Toamasina</strong>
                                    <div class="text-muted">300 kg de Riz</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-info">750 000 Ar</span>
                                    <div class="activity-date">15/02/2026</div>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Mananjary</strong>
                                    <div class="text-muted">150 L d'Huile</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-info">1 350 000 Ar</span>
                                    <div class="activity-date">14/02/2026</div>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Mahanoro</strong>
                                    <div class="text-muted">50 Tôles</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-info">1 250 000 Ar</span>
                                    <div class="activity-date">13/02/2026</div>
                                </div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Vatomandry</strong>
                                    <div class="text-muted">200 kg de Riz</div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-info">500 000 Ar</span>
                                    <div class="activity-date">12/02/2026</div>
                                </div>
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
                        <li><a>À propos</a></li>
                        <li><a>Contact</a></li>
                        <li><a>Aide</a></li>
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
    <script src="<?= $base ?>js/app.js"></script>
    
</body>
</html>