<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Attributions - BNGRC</title>
    
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
                            <a class="nav-link active" href="attributions.html">Attributions</a>
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
                    <li class="breadcrumb-item active">Attributions</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Gestion des Attributions</h1>
                    <p class="text-muted">Suivi des dons attribués aux villes sinistrées</p>
                </div>
                <div>
                    <a href="simulation.html" class="btn btn-outline-primary me-2">
                        <i class="bi bi-graph-up"></i> Simulation Dispatch
                    </a>
                    <a href="attribution-ajouter.html" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Ajouter Attribution
                    </a>
                </div>
            </div>

            <!-- Statistiques rapides -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h3 class="mb-0">10</h3>
                            <small>Total Attributions</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h3 class="mb-0">10 850 000 Ar</h3>
                            <small>Valeur Totale</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h3 class="mb-0">5</h3>
                            <small>Villes Servies</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h3 class="mb-0">2 170 000 Ar</h3>
                            <small>Moyenne par Ville</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="filters-container">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="searchAttribution" class="form-label">Rechercher</label>
                        <input type="text" class="form-control" id="searchAttribution" placeholder="Rechercher...">
                    </div>
                    <div class="col-md-2">
                        <label for="filterVille" class="form-label">Ville</label>
                        <select class="form-select" id="filterVille">
                            <option value="">Toutes</option>
                            <option value="Toamasina">Toamasina</option>
                            <option value="Mananjary">Mananjary</option>
                            <option value="Mahanoro">Mahanoro</option>
                            <option value="Vatomandry">Vatomandry</option>
                            <option value="Antalaha">Antalaha</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterType" class="form-label">Type</label>
                        <select class="form-select" id="filterType">
                            <option value="">Tous</option>
                            <option value="Riz">Riz</option>
                            <option value="Huile">Huile</option>
                            <option value="Tôle">Tôle</option>
                            <option value="Ciment">Ciment</option>
                            <option value="Eau potable">Eau potable</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterStatut" class="form-label">Statut</label>
                        <select class="form-select" id="filterStatut">
                            <option value="">Tous</option>
                            <option value="En cours">En cours</option>
                            <option value="Livré">Livré</option>
                            <option value="En attente">En attente</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterDateDebut" class="form-label">Date Début</label>
                        <input type="date" class="form-control" id="filterDateDebut">
                    </div>
                </div>
            </div>

            <!-- Tableau des attributions -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0">Liste des Attributions (10 résultats)</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="attributionsTable">
                        <thead>
                            <tr>
                                <th class="sortable">Date</th>
                                <th class="sortable">Type de Don</th>
                                <th class="sortable">Quantité</th>
                                <th class="sortable">Ville</th>
                                <th class="sortable">Valeur</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/02/2026</td>
                                <td>Riz</td>
                                <td>300 kg</td>
                                <td>Toamasina</td>
                                <td>750 000 Ar</td>
                                <td><span class="badge bg-success">Livré</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 1)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>14/02/2026</td>
                                <td>Huile</td>
                                <td>150 L</td>
                                <td>Mananjary</td>
                                <td>1 350 000 Ar</td>
                                <td><span class="badge bg-info">En cours</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 2)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>13/02/2026</td>
                                <td>Tôle</td>
                                <td>50 unités</td>
                                <td>Mahanoro</td>
                                <td>1 250 000 Ar</td>
                                <td><span class="badge bg-success">Livré</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 3)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>12/02/2026</td>
                                <td>Riz</td>
                                <td>200 kg</td>
                                <td>Vatomandry</td>
                                <td>500 000 Ar</td>
                                <td><span class="badge bg-success">Livré</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 4)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>12/02/2026</td>
                                <td>Ciment</td>
                                <td>80 sacs</td>
                                <td>Toamasina</td>
                                <td>2 400 000 Ar</td>
                                <td><span class="badge bg-info">En cours</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 5)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>11/02/2026</td>
                                <td>Huile</td>
                                <td>100 L</td>
                                <td>Antalaha</td>
                                <td>900 000 Ar</td>
                                <td><span class="badge bg-success">Livré</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 6)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>11/02/2026</td>
                                <td>Eau potable</td>
                                <td>500 L</td>
                                <td>Mananjary</td>
                                <td>500 000 Ar</td>
                                <td><span class="badge bg-success">Livré</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 7)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>10/02/2026</td>
                                <td>Tôle</td>
                                <td>40 unités</td>
                                <td>Vatomandry</td>
                                <td>1 000 000 Ar</td>
                                <td><span class="badge bg-info">En cours</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 8)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>10/02/2026</td>
                                <td>Riz</td>
                                <td>250 kg</td>
                                <td>Mahanoro</td>
                                <td>625 000 Ar</td>
                                <td><span class="badge bg-warning">En attente</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 9)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>09/02/2026</td>
                                <td>Ciment</td>
                                <td>50 sacs</td>
                                <td>Antalaha</td>
                                <td>1 575 000 Ar</td>
                                <td><span class="badge bg-success">Livré</span></td>
                                <td>
                                    <a href="attribution-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('attribution', 10)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Pagination">
                    <ul class="pagination justify-content-center"></ul>
                </nav>
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
    
    <!-- Scripts spécifiques -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rendre le tableau triable
            makeSortable('attributionsTable');
            
            // Initialiser les filtres
            filterTable('searchAttribution', 'attributionsTable');
            
            // Initialiser la pagination
            initPagination('attributionsTable', 10);
        });
    </script>
</body>
</html>
