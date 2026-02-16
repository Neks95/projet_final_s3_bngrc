<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Besoins - BNGRC</title>
    
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
                    <li class="breadcrumb-item active">Besoins</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Gestion des Besoins</h1>
                    <p class="text-muted">Liste des besoins identifiés par ville</p>
                </div>
                <a href="besoin-ajouter.html" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter un Besoin
                </a>
            </div>

            <!-- Statistiques rapides -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h3 class="mb-0">45 680 000 Ar</h3>
                            <small>Besoins Totaux</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h3 class="mb-0">27 890 000 Ar</h3>
                            <small>Besoins Couverts</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h3 class="mb-0">17 790 000 Ar</h3>
                            <small>Reste à Couvrir</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h3 class="mb-0">15</h3>
                            <small>Besoins Enregistrés</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="filters-container">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="searchBesoin" class="form-label">Rechercher</label>
                        <input type="text" class="form-control" id="searchBesoin" placeholder="Rechercher...">
                    </div>
                    <div class="col-md-3">
                        <label for="filterVille" class="form-label">Filtrer par Ville</label>
                        <select class="form-select" id="filterVille">
                            <option value="">Toutes les villes</option>
                            <option value="toamasina">Toamasina</option>
                            <option value="mananjary">Mananjary</option>
                            <option value="mahanoro">Mahanoro</option>
                            <option value="vatomandry">Vatomandry</option>
                            <option value="brickaville">Brickaville</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterCategorie" class="form-label">Filtrer par Catégorie</label>
                        <select class="form-select" id="filterCategorie">
                            <option value="">Toutes les catégories</option>
                            <option value="nature">Nature</option>
                            <option value="matériaux">Matériaux</option>
                            <option value="argent">Argent</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filterStatut" class="form-label">Filtrer par Statut</label>
                        <select class="form-select" id="filterStatut">
                            <option value="">Tous les statuts</option>
                            <option value="couvert">Couvert</option>
                            <option value="partiellement">Partiellement couvert</option>
                            <option value="non">Non couvert</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tableau des besoins -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0">Liste des Besoins (15 résultats)</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="besoinsTable">
                        <thead>
                            <tr>
                                <th class="sortable">Ville</th>
                                <th class="sortable">Catégorie</th>
                                <th class="sortable">Type de Besoin</th>
                                <th class="sortable">Quantité</th>
                                <th class="sortable">Prix Unitaire</th>
                                <th class="sortable">Montant Total</th>
                                <th class="sortable">Attribué</th>
                                <th class="sortable">Reste</th>
                                <th class="sortable">Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Toamasina</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Riz</td>
                                <td>1 000 kg</td>
                                <td>2 500 Ar</td>
                                <td>2 500 000 Ar</td>
                                <td>750 000 Ar</td>
                                <td>1 750 000 Ar</td>
                                <td>10/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 1)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Toamasina</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Huile</td>
                                <td>500 L</td>
                                <td>9 000 Ar</td>
                                <td>4 500 000 Ar</td>
                                <td>0 Ar</td>
                                <td>4 500 000 Ar</td>
                                <td>10/02/2026</td>
                                <td><span class="badge bg-danger">Non couvert</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 2)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Toamasina</td>
                                <td><span class="badge bg-warning">Matériaux</span></td>
                                <td>Tôle</td>
                                <td>200 unités</td>
                                <td>25 000 Ar</td>
                                <td>5 000 000 Ar</td>
                                <td>5 000 000 Ar</td>
                                <td>0 Ar</td>
                                <td>11/02/2026</td>
                                <td><span class="badge bg-success">Couvert</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 3)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mananjary</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Riz</td>
                                <td>800 kg</td>
                                <td>2 500 Ar</td>
                                <td>2 000 000 Ar</td>
                                <td>1 500 000 Ar</td>
                                <td>500 000 Ar</td>
                                <td>10/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 4)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mananjary</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Huile</td>
                                <td>400 L</td>
                                <td>9 000 Ar</td>
                                <td>3 600 000 Ar</td>
                                <td>1 350 000 Ar</td>
                                <td>2 250 000 Ar</td>
                                <td>10/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 5)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mananjary</td>
                                <td><span class="badge bg-warning">Matériaux</span></td>
                                <td>Tôle</td>
                                <td>150 unités</td>
                                <td>25 000 Ar</td>
                                <td>3 750 000 Ar</td>
                                <td>3 750 000 Ar</td>
                                <td>0 Ar</td>
                                <td>11/02/2026</td>
                                <td><span class="badge bg-success">Couvert</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 6)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mahanoro</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Riz</td>
                                <td>600 kg</td>
                                <td>2 500 Ar</td>
                                <td>1 500 000 Ar</td>
                                <td>1 000 000 Ar</td>
                                <td>500 000 Ar</td>
                                <td>11/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 7)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mahanoro</td>
                                <td><span class="badge bg-warning">Matériaux</span></td>
                                <td>Tôle</td>
                                <td>100 unités</td>
                                <td>25 000 Ar</td>
                                <td>2 500 000 Ar</td>
                                <td>1 250 000 Ar</td>
                                <td>1 250 000 Ar</td>
                                <td>11/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 8)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Mahanoro</td>
                                <td><span class="badge bg-warning">Matériaux</span></td>
                                <td>Ciment</td>
                                <td>50 sacs</td>
                                <td>35 000 Ar</td>
                                <td>1 750 000 Ar</td>
                                <td>0 Ar</td>
                                <td>1 750 000 Ar</td>
                                <td>12/02/2026</td>
                                <td><span class="badge bg-danger">Non couvert</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 9)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Vatomandry</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Riz</td>
                                <td>500 kg</td>
                                <td>2 500 Ar</td>
                                <td>1 250 000 Ar</td>
                                <td>500 000 Ar</td>
                                <td>750 000 Ar</td>
                                <td>12/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 10)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Vatomandry</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Sucre</td>
                                <td>300 kg</td>
                                <td>4 000 Ar</td>
                                <td>1 200 000 Ar</td>
                                <td>0 Ar</td>
                                <td>1 200 000 Ar</td>
                                <td>12/02/2026</td>
                                <td><span class="badge bg-danger">Non couvert</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 11)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Vatomandry</td>
                                <td><span class="badge bg-warning">Matériaux</span></td>
                                <td>Tôle</td>
                                <td>80 unités</td>
                                <td>25 000 Ar</td>
                                <td>2 000 000 Ar</td>
                                <td>1 500 000 Ar</td>
                                <td>500 000 Ar</td>
                                <td>12/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 12)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Brickaville</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Riz</td>
                                <td>400 kg</td>
                                <td>2 500 Ar</td>
                                <td>1 000 000 Ar</td>
                                <td>0 Ar</td>
                                <td>1 000 000 Ar</td>
                                <td>13/02/2026</td>
                                <td><span class="badge bg-danger">Non couvert</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 13)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Brickaville</td>
                                <td><span class="badge bg-success">Nature</span></td>
                                <td>Eau potable</td>
                                <td>500 L</td>
                                <td>1 000 Ar</td>
                                <td>500 000 Ar</td>
                                <td>0 Ar</td>
                                <td>500 000 Ar</td>
                                <td>13/02/2026</td>
                                <td><span class="badge bg-danger">Non couvert</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 14)" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Brickaville</td>
                                <td><span class="badge bg-info">Argent</span></td>
                                <td>Don financier</td>
                                <td>1</td>
                                <td>1 500 000 Ar</td>
                                <td>1 500 000 Ar</td>
                                <td>500 000 Ar</td>
                                <td>1 000 000 Ar</td>
                                <td>13/02/2026</td>
                                <td><span class="badge bg-warning">Partiellement</span></td>
                                <td>
                                    <a href="besoin-modifier.html" class="btn btn-sm btn-warning" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" onclick="handleDelete('besoin', 15)" title="Supprimer">
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
            makeSortable('besoinsTable');
            
            // Initialiser les filtres
            filterTable('searchBesoin', 'besoinsTable');
            filterTableBySelect('filterVille', 'besoinsTable', 0);
            filterTableBySelect('filterCategorie', 'besoinsTable', 1);
            
            // Initialiser la pagination
            initPagination('besoinsTable', 10);
        });
    </script>
</body>
</html>
