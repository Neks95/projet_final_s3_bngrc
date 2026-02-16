<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Villes - BNGRC</title>
    
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
                    <li class="breadcrumb-item active">Villes</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Gestion des Villes</h1>
                    <p class="text-muted">Liste des villes affectées par les catastrophes</p>
                </div>
                <a href="ville-ajouter.html" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter une Ville
                </a>
            </div>

            <!-- Filtres et Recherche -->
            <div class="filters-container">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="searchVille" class="form-label">Rechercher</label>
                        <input type="text" class="form-control" id="searchVille" placeholder="Rechercher par nom de ville...">
                    </div>
                    <div class="col-md-3">
                        <label for="filterRegion" class="form-label">Filtrer par Région</label>
                        <select class="form-select" id="filterRegion">
                            <option value="">Toutes les régions</option>
                            <option value="atsinanana">Atsinanana</option>
                            <option value="vatovavy">Vatovavy Fitovinany</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="sortBy" class="form-label">Trier par</label>
                        <select class="form-select" id="sortBy">
                            <option value="nom">Nom</option>
                            <option value="sinistres">Nombre de sinistrés</option>
                            <option value="region">Région</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tableau des villes -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0">Liste des Villes (5 résultats)</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="villesTable">
                        <thead>
                            <tr>
                                <th class="sortable">Nom</th>
                                <th class="sortable">Région</th>
                                <th class="sortable">Nombre de Sinistrés</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Toamasina</strong></td>
                                <td>Atsinanana</td>
                                <td>5 200</td>
                                <td>
                                    <a href="ville-details.html" class="btn btn-sm btn-info" title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="ville-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('ville', 1)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mananjary</strong></td>
                                <td>Vatovavy Fitovinany</td>
                                <td>4 800</td>
                                <td>
                                    <a href="ville-details.html" class="btn btn-sm btn-info" title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="ville-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('ville', 2)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mahanoro</strong></td>
                                <td>Atsinanana</td>
                                <td>3 500</td>
                                <td>
                                    <a href="ville-details.html" class="btn btn-sm btn-info" title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="ville-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('ville', 3)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Vatomandry</strong></td>
                                <td>Atsinanana</td>
                                <td>3 000</td>
                                <td>
                                    <a href="ville-details.html" class="btn btn-sm btn-info" title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="ville-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('ville', 4)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Brickaville</strong></td>
                                <td>Atsinanana</td>
                                <td>2 000</td>
                                <td>
                                    <a href="ville-details.html" class="btn btn-sm btn-info" title="Voir les détails">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="ville-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('ville', 5)" title="Supprimer">
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
            makeSortable('villesTable');
            
            // Initialiser les filtres
            filterTable('searchVille', 'villesTable');
            filterTableBySelect('filterRegion', 'villesTable', 1);
            
            // Initialiser la pagination
            initPagination('villesTable', 10);
        });
    </script>
</body>
</html>
