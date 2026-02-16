<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Ville - BNGRC</title>
    
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
                    <li class="breadcrumb-item"><a href="villes.html">Villes</a></li>
                    <li class="breadcrumb-item active">Toamasina</li>
                </ol>
            </nav>

            <!-- Page Title et Actions -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Toamasina</h1>
                    <p class="text-muted">Détails de la ville et statistiques</p>
                </div>
                <div>
                    <a href="ville-modifier.html" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="villes.html" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>

            <!-- Informations générales -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body">
                            <div class="stat-icon bg-danger text-white">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="stat-value">5 200</div>
                            <div class="stat-label">Sinistrés</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body">
                            <div class="stat-icon bg-warning text-white">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div class="stat-value">12 500 000 Ar</div>
                            <div class="stat-label">Besoins Totaux</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body">
                            <div class="stat-icon bg-success text-white">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="stat-value">8 900 000 Ar</div>
                            <div class="stat-label">Dons Attribués</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card card">
                        <div class="card-body">
                            <div class="stat-icon bg-primary text-white">
                                <i class="bi bi-percent"></i>
                            </div>
                            <div class="stat-value">71%</div>
                            <div class="stat-label">Taux de Couverture</div>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-warning" style="width: 71%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations détaillées -->
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <div class="card shadow-custom h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="bi bi-info-circle text-primary"></i> Informations Générales
                            </h5>
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Région :</strong></td>
                                    <td>Atsinanana</td>
                                </tr>
                                <tr>
                                    <td><strong>Sinistrés :</strong></td>
                                    <td>5 200 personnes</td>
                                </tr>
                                <tr>
                                    <td><strong>Date d'enregistrement :</strong></td>
                                    <td>10/02/2026</td>
                                </tr>
                                <tr>
                                    <td><strong>Dernière mise à jour :</strong></td>
                                    <td>14/02/2026</td>
                                </tr>
                            </table>
                            <div class="mt-3">
                                <h6>Description</h6>
                                <p class="text-muted">Ville portuaire fortement touchée par le cyclone. Infrastructures endommagées.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-custom h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="bi bi-bar-chart text-success"></i> Répartition des Besoins par Catégorie
                            </h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="border rounded p-3 text-center">
                                        <h3 class="text-success">4 500 000 Ar</h3>
                                        <p class="mb-0">Nature</p>
                                        <small class="text-muted">36%</small>
                                        <div class="progress mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 36%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 text-center">
                                        <h3 class="text-warning">6 000 000 Ar</h3>
                                        <p class="mb-0">Matériaux</p>
                                        <small class="text-muted">48%</small>
                                        <div class="progress mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-warning" style="width: 48%"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 text-center">
                                        <h3 class="text-info">2 000 000 Ar</h3>
                                        <p class="mb-0">Argent</p>
                                        <small class="text-muted">16%</small>
                                        <div class="progress mt-2" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 16%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Besoins de la ville -->
            <div class="table-container">
                <h4 class="mb-3">Besoins de la Ville</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Catégorie</th>
                                <th>Type</th>
                                <th>Quantité Nécessaire</th>
                                <th>Prix Unitaire</th>
                                <th>Montant Total</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Riz</td>
                                <td>1 000 kg</td>
                                <td>2 500 Ar</td>
                                <td>2 500 000 Ar</td>
                                <td><span class="badge bg-warning">Partiellement couvert</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Huile</td>
                                <td>500 L</td>
                                <td>9 000 Ar</td>
                                <td>4 500 000 Ar</td>
                                <td><span class="badge bg-danger">Non couvert</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-warning">Matériaux</span></td>
                                <td>Tôle</td>
                                <td>200 unités</td>
                                <td>25 000 Ar</td>
                                <td>5 000 000 Ar</td>
                                <td><span class="badge bg-success">Couvert</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-info">Argent</span></td>
                                <td>Don financier</td>
                                <td>1</td>
                                <td>2 000 000 Ar</td>
                                <td>2 000 000 Ar</td>
                                <td><span class="badge bg-warning">Partiellement couvert</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Dons attribués -->
            <div class="table-container">
                <h4 class="mb-3">Dons Attribués à la Ville</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type de Don</th>
                                <th>Quantité</th>
                                <th>Valeur</th>
                                <th>Donateur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/02/2026</td>
                                <td>Riz</td>
                                <td>300 kg</td>
                                <td>750 000 Ar</td>
                                <td>ONG Croix Rouge</td>
                            </tr>
                            <tr>
                                <td>14/02/2026</td>
                                <td>Tôle</td>
                                <td>100 unités</td>
                                <td>2 500 000 Ar</td>
                                <td>Association Vatosoa</td>
                            </tr>
                            <tr>
                                <td>13/02/2026</td>
                                <td>Don financier</td>
                                <td>1</td>
                                <td>500 000 Ar</td>
                                <td>M. Rakoto Jean</td>
                            </tr>
                        </tbody>
                    </table>
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
