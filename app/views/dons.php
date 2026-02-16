<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Dons - BNGRC</title>
    
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
                            <a class="nav-link active" href="dons.html">Dons</a>
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
                    <li class="breadcrumb-item active">Dons</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Gestion des Dons</h1>
                    <p class="text-muted">Liste des dons reçus et leur statut</p>
                </div>
                <a href="don-ajouter.html" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter un Don
                </a>
            </div>

            <!-- Statistiques rapides -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h3 class="mb-0">52 750 000 Ar</h3>
                            <small>Total Dons</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h3 class="mb-0">3</h3>
                            <small>En Attente</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h3 class="mb-0">4</h3>
                            <small>Attribués</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h3 class="mb-0">3</h3>
                            <small>Distribués</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="filters-container">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="searchDon" class="form-label">Rechercher</label>
                        <input type="text" class="form-control" id="searchDon" placeholder="Rechercher...">
                    </div>
                    <div class="col-md-2">
                        <label for="filterStatut" class="form-label">Statut</label>
                        <select class="form-select" id="filterStatut">
                            <option value="">Tous</option>
                            <option value="attente">En attente</option>
                            <option value="attribue">Attribué</option>
                            <option value="distribue">Distribué</option>
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
                            <option value="Don financier">Don financier</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterDonateur" class="form-label">Donateur</label>
                        <input type="text" class="form-control" id="filterDonateur" placeholder="Nom du donateur">
                    </div>
                    <div class="col-md-2">
                        <label for="filterDate" class="form-label">Date</label>
                        <input type="date" class="form-control" id="filterDate">
                    </div>
                </div>
            </div>

            <!-- Tableau des dons -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0">Liste des Dons (10 résultats)</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="donsTable">
                        <thead>
                            <tr>
                                <th class="sortable">Type</th>
                                <th class="sortable">Quantité</th>
                                <th class="sortable">Valeur Unitaire</th>
                                <th class="sortable">Valeur Totale</th>
                                <th class="sortable">Donateur</th>
                                <th class="sortable">Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Riz</td>
                                <td>500 kg</td>
                                <td>2 500 Ar</td>
                                <td>1 250 000 Ar</td>
                                <td>ONG Croix Rouge</td>
                                <td>15/02/2026</td>
                                <td><span class="badge bg-success">Distribué</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 1)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Huile</td>
                                <td>200 L</td>
                                <td>9 000 Ar</td>
                                <td>1 800 000 Ar</td>
                                <td>Entreprise STAR</td>
                                <td>14/02/2026</td>
                                <td><span class="badge bg-info">Attribué</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 2)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Don financier</td>
                                <td>1</td>
                                <td>5 000 000 Ar</td>
                                <td>5 000 000 Ar</td>
                                <td>M. Rakoto Jean</td>
                                <td>13/02/2026</td>
                                <td><span class="badge bg-secondary">En attente</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 3)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Tôle</td>
                                <td>100 unités</td>
                                <td>25 000 Ar</td>
                                <td>2 500 000 Ar</td>
                                <td>Association Vatosoa</td>
                                <td>13/02/2026</td>
                                <td><span class="badge bg-success">Distribué</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 4)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Riz</td>
                                <td>300 kg</td>
                                <td>2 500 Ar</td>
                                <td>750 000 Ar</td>
                                <td>Mme Ranaivo Marie</td>
                                <td>12/02/2026</td>
                                <td><span class="badge bg-info">Attribué</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 5)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Ciment</td>
                                <td>80 sacs</td>
                                <td>35 000 Ar</td>
                                <td>2 800 000 Ar</td>
                                <td>Société HOLCIM</td>
                                <td>12/02/2026</td>
                                <td><span class="badge bg-success">Distribué</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 6)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Huile</td>
                                <td>150 L</td>
                                <td>9 000 Ar</td>
                                <td>1 350 000 Ar</td>
                                <td>ONG Médecins du Monde</td>
                                <td>11/02/2026</td>
                                <td><span class="badge bg-info">Attribué</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 7)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Sucre</td>
                                <td>250 kg</td>
                                <td>4 000 Ar</td>
                                <td>1 000 000 Ar</td>
                                <td>M. Andrianina Paul</td>
                                <td>11/02/2026</td>
                                <td><span class="badge bg-secondary">En attente</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 8)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Bois</td>
                                <td>200 planches</td>
                                <td>15 000 Ar</td>
                                <td>3 000 000 Ar</td>
                                <td>Entreprise RANOVAO</td>
                                <td>10/02/2026</td>
                                <td><span class="badge bg-info">Attribué</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 9)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Haricots</td>
                                <td>400 kg</td>
                                <td>3 500 Ar</td>
                                <td>1 400 000 Ar</td>
                                <td>Mme Ravao Soanirina</td>
                                <td>10/02/2026</td>
                                <td><span class="badge bg-secondary">En attente</span></td>
                                <td>
                                    <a href="don-details.html" class="btn btn-sm btn-info" title="Détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="don-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('don', 10)" title="Supprimer">
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
            makeSortable('donsTable');
            
            // Initialiser les filtres
            filterTable('searchDon', 'donsTable');
            
            // Initialiser la pagination
            initPagination('donsTable', 10);
        });
    </script>
</body>
</html>
