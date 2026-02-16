<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Don - BNGRC</title>
    
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
                    <li class="breadcrumb-item active">Ajouter</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Ajouter un Don</h1>
                <p class="text-muted">Enregistrer un nouveau don reçu</p>
            </div>

            <!-- Formulaire -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-container">
                        <form id="addDonForm" onsubmit="handleAddForm(event, 'don')">
                            <div class="mb-3">
                                <label for="type" class="form-label">
                                    Type de Don <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="Riz">Riz</option>
                                    <option value="Huile">Huile</option>
                                    <option value="Sucre">Sucre</option>
                                    <option value="Sel">Sel</option>
                                    <option value="Haricots">Haricots</option>
                                    <option value="Eau potable">Eau potable</option>
                                    <option value="Tôle">Tôle</option>
                                    <option value="Clou">Clou</option>
                                    <option value="Ciment">Ciment</option>
                                    <option value="Bois">Bois</option>
                                    <option value="Briques">Briques</option>
                                    <option value="Don financier">Don financier</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un type de don.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantite" class="form-label">
                                        Quantité <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="quantite" name="quantite" required min="0.01" step="0.01" placeholder="Ex: 500">
                                    <div class="invalid-feedback">
                                        Veuillez saisir une quantité valide.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="valeur_unitaire" class="form-label">
                                        Valeur Unitaire (Ar) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="valeur_unitaire" name="valeur_unitaire" required min="0" step="0.01" placeholder="Ex: 2500.00">
                                    <div class="invalid-feedback">
                                        Veuillez saisir une valeur unitaire valide.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="valeur_totale" class="form-label">
                                    Valeur Totale (Ar)
                                </label>
                                <input type="text" class="form-control bg-light" id="valeur_totale" name="valeur_totale" readonly placeholder="0.00 Ar">
                                <small class="form-text text-muted">Calculé automatiquement (Quantité × Valeur Unitaire)</small>
                            </div>

                            <div class="mb-3">
                                <label for="donateur" class="form-label">
                                    Nom du Donateur <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="donateur" name="donateur" required placeholder="Ex: ONG Croix Rouge, M. Rakoto Jean">
                                <div class="invalid-feedback">
                                    Veuillez saisir le nom du donateur.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="organisation" class="form-label">
                                    Organisation (optionnel)
                                </label>
                                <input type="text" class="form-control" id="organisation" name="organisation" placeholder="Ex: ONG, Entreprise, Association">
                            </div>

                            <div class="mb-3">
                                <label for="date_don" class="form-label">
                                    Date du Don <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="date_don" name="date_don" required>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une date.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Statut Initial</label>
                                <div>
                                    <span class="badge bg-secondary">En attente</span>
                                    <small class="form-text text-muted d-block mt-1">
                                        Les nouveaux dons sont automatiquement mis en attente d'attribution
                                    </small>
                                </div>
                                <input type="hidden" name="statut" value="En attente">
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes (optionnel)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Informations complémentaires sur le don..."></textarea>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Enregistrer
                                </button>
                                <a href="dons.html" class="btn btn-secondary">
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
                                <strong>Type de Don :</strong> Sélectionnez le type de don reçu parmi les catégories disponibles (denrées, matériaux, argent).
                            </p>
                            <p class="card-text">
                                <strong>Quantité :</strong> Indiquez la quantité du don (en kg, L, unités, etc.).
                            </p>
                            <p class="card-text">
                                <strong>Valeur Totale :</strong> Ce champ se calcule automatiquement en multipliant la quantité par la valeur unitaire.
                            </p>
                            <p class="card-text">
                                <strong>Donateur :</strong> Précisez le nom complet du donateur (personne physique ou morale).
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-custom mt-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-lightbulb text-warning"></i> Conseil
                            </h5>
                            <p class="card-text">
                                Assurez-vous d'enregistrer tous les dons dès leur réception. Cela permet une meilleure traçabilité et facilite les attributions futures.
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-custom mt-3 bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Types de dons disponibles :</h6>
                            <p class="mb-2"><strong>Denrées :</strong><br>
                            <small>Riz, Huile, Sucre, Sel, Haricots, Eau potable</small></p>
                            <p class="mb-2"><strong>Matériaux :</strong><br>
                            <small>Tôle, Clou, Ciment, Bois, Briques</small></p>
                            <p class="mb-0"><strong>Financier :</strong><br>
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
            const quantiteInput = document.getElementById('quantite');
            const valeurUnitaireInput = document.getElementById('valeur_unitaire');
            const valeurTotaleInput = document.getElementById('valeur_totale');
            
            // Calculate total value automatically
            function calculateTotal() {
                const quantite = parseFloat(quantiteInput.value) || 0;
                const valeurUnitaire = parseFloat(valeurUnitaireInput.value) || 0;
                const total = quantite * valeurUnitaire;
                
                valeurTotaleInput.value = total.toLocaleString('fr-FR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + ' Ar';
            }
            
            quantiteInput.addEventListener('input', calculateTotal);
            valeurUnitaireInput.addEventListener('input', calculateTotal);
            
            // Set default date to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date_don').value = today;
        });
    </script>
</body>
</html>
