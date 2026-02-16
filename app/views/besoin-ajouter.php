<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Besoin - BNGRC</title>
    
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
                    <li class="breadcrumb-item"><a href="besoins.html">Besoins</a></li>
                    <li class="breadcrumb-item active">Ajouter</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Ajouter un Besoin</h1>
                <p class="text-muted">Enregistrer un nouveau besoin identifié</p>
            </div>

            <!-- Formulaire -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-container">
                        <form id="addBesoinForm" onsubmit="handleAddForm(event, 'besoin')">
                            <div class="mb-3">
                                <label for="ville" class="form-label">
                                    Ville <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="ville" name="ville" required>
                                    <option value="">Sélectionner une ville</option>
                                    <option value="Toamasina">Toamasina</option>
                                    <option value="Mananjary">Mananjary</option>
                                    <option value="Mahanoro">Mahanoro</option>
                                    <option value="Vatomandry">Vatomandry</option>
                                    <option value="Brickaville">Brickaville</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une ville.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">
                                    Catégorie <span class="text-danger">*</span>
                                </label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="categorie" id="categorie_nature" value="Nature" required>
                                        <label class="form-check-label" for="categorie_nature">
                                            <span class="badge bg-success">Nature</span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="categorie" id="categorie_materiaux" value="Matériaux">
                                        <label class="form-check-label" for="categorie_materiaux">
                                            <span class="badge bg-warning">Matériaux</span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="categorie" id="categorie_argent" value="Argent">
                                        <label class="form-check-label" for="categorie_argent">
                                            <span class="badge bg-info">Argent</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une catégorie.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">
                                    Type de Besoin <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="type" name="type" required disabled>
                                    <option value="">Sélectionner d'abord une catégorie</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un type de besoin.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantite" class="form-label">
                                        Quantité <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="quantite" name="quantite" required min="1" step="1" placeholder="Ex: 1000">
                                    <div class="invalid-feedback">
                                        Veuillez saisir une quantité valide.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="prix_unitaire" class="form-label">
                                        Prix Unitaire (Ar) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" required min="0" step="0.01" placeholder="Ex: 2500.00">
                                    <div class="invalid-feedback">
                                        Veuillez saisir un prix unitaire valide.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="montant_total" class="form-label">
                                    Montant Total (Ar)
                                </label>
                                <input type="text" class="form-control bg-light" id="montant_total" name="montant_total" readonly placeholder="0.00 Ar">
                                <small class="form-text text-muted">Calculé automatiquement (Quantité × Prix Unitaire)</small>
                            </div>

                            <div class="mb-3">
                                <label for="date_besoin" class="form-label">
                                    Date <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="date_besoin" name="date_besoin" required>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une date.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes (optionnel)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Informations complémentaires sur le besoin..."></textarea>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Enregistrer
                                </button>
                                <a href="besoins.html" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Aide -->
                <div class="col-lg-4">
                    <div class="card shadow-custom">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-question-circle text-primary"></i> Aide
                            </h5>
                            <p class="card-text">
                                <strong>Ville :</strong> Sélectionnez la ville concernée par ce besoin.
                            </p>
                            <p class="card-text">
                                <strong>Catégorie :</strong> Choisissez le type de besoin (Nature pour denrées, Matériaux pour construction, Argent pour aide financière).
                            </p>
                            <p class="card-text">
                                <strong>Type :</strong> Le type se met à jour automatiquement selon la catégorie sélectionnée.
                            </p>
                            <p class="card-text">
                                <strong>Montant Total :</strong> Ce champ se calcule automatiquement en multipliant la quantité par le prix unitaire.
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-custom mt-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-lightbulb text-warning"></i> Conseil
                            </h5>
                            <p class="card-text">
                                Vérifiez bien les quantités et les prix avant d'enregistrer. Ces informations sont essentielles pour la planification des distributions.
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-custom mt-3 bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Types disponibles par catégorie :</h6>
                            <p class="mb-2"><strong>Nature :</strong><br>
                            <small>Riz, Huile, Sucre, Sel, Haricots, Eau potable</small></p>
                            <p class="mb-2"><strong>Matériaux :</strong><br>
                            <small>Tôle, Clou, Ciment, Bois, Briques</small></p>
                            <p class="mb-0"><strong>Argent :</strong><br>
                            <small>Don financier</small></p>
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
    
    <!-- Page-specific scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorieRadios = document.querySelectorAll('input[name="categorie"]');
            const typeSelect = document.getElementById('type');
            const quantiteInput = document.getElementById('quantite');
            const prixUnitaireInput = document.getElementById('prix_unitaire');
            const montantTotalInput = document.getElementById('montant_total');
            
            // Type options based on category
            const typeOptions = {
                'Nature': ['Riz', 'Huile', 'Sucre', 'Sel', 'Haricots', 'Eau potable'],
                'Matériaux': ['Tôle', 'Clou', 'Ciment', 'Bois', 'Briques'],
                'Argent': ['Don financier']
            };
            
            // Update type dropdown when category changes
            categorieRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedCategorie = this.value;
                    typeSelect.disabled = false;
                    typeSelect.innerHTML = '<option value="">Sélectionner un type</option>';
                    
                    if (typeOptions[selectedCategorie]) {
                        typeOptions[selectedCategorie].forEach(type => {
                            const option = document.createElement('option');
                            option.value = type;
                            option.textContent = type;
                            typeSelect.appendChild(option);
                        });
                    }
                });
            });
            
            // Calculate total amount automatically
            function calculateTotal() {
                const quantite = parseFloat(quantiteInput.value) || 0;
                const prixUnitaire = parseFloat(prixUnitaireInput.value) || 0;
                const total = quantite * prixUnitaire;
                
                montantTotalInput.value = total.toLocaleString('fr-FR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + ' Ar';
            }
            
            quantiteInput.addEventListener('input', calculateTotal);
            prixUnitaireInput.addEventListener('input', calculateTotal);
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date_besoin').value = today;
        });
    </script>
</body>
</html>
