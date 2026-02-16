<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Don - BNGRC</title>
    
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
                    <li class="breadcrumb-item active">Modifier</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Modifier un Don</h1>
                <p class="text-muted">Mettre à jour les informations du don</p>
            </div>

            <!-- Formulaire -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-container">
                        <form id="editDonForm" onsubmit="handleEditForm(event, 'don')">
                            <div class="mb-3">
                                <label for="type" class="form-label">
                                    Type de Don <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="Riz" selected>Riz</option>
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
                                    <input type="number" class="form-control" id="quantite" name="quantite" required min="0.01" step="0.01" value="500" placeholder="Ex: 500">
                                    <div class="invalid-feedback">
                                        Veuillez saisir une quantité valide.
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="valeur_unitaire" class="form-label">
                                        Valeur Unitaire (Ar) <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="valeur_unitaire" name="valeur_unitaire" required min="0" step="0.01" value="2500" placeholder="Ex: 2500.00">
                                    <div class="invalid-feedback">
                                        Veuillez saisir une valeur unitaire valide.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="valeur_totale" class="form-label">
                                    Valeur Totale (Ar)
                                </label>
                                <input type="text" class="form-control bg-light" id="valeur_totale" name="valeur_totale" readonly value="1 250 000.00 Ar">
                                <small class="form-text text-muted">Calculé automatiquement (Quantité × Valeur Unitaire)</small>
                            </div>

                            <div class="mb-3">
                                <label for="donateur" class="form-label">
                                    Nom du Donateur <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="donateur" name="donateur" required value="ONG Croix Rouge" placeholder="Ex: ONG Croix Rouge, M. Rakoto Jean">
                                <div class="invalid-feedback">
                                    Veuillez saisir le nom du donateur.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="organisation" class="form-label">
                                    Organisation (optionnel)
                                </label>
                                <input type="text" class="form-control" id="organisation" name="organisation" value="Organisation Non Gouvernementale" placeholder="Ex: ONG, Entreprise, Association">
                            </div>

                            <div class="mb-3">
                                <label for="date_don" class="form-label">
                                    Date du Don <span class="text-danger">*</span>
                                </label>
                                <input type="date" class="form-control" id="date_don" name="date_don" required value="2026-02-15">
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une date.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="statut" class="form-label">
                                    Statut <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="statut" name="statut" required>
                                    <option value="En attente">En attente</option>
                                    <option value="Attribué">Attribué</option>
                                    <option value="Distribué" selected>Distribué</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un statut.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes (optionnel)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Informations complémentaires sur le don...">Don reçu en excellent état. Distribution effectuée à Toamasina.</textarea>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Mettre à jour
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
                                <strong>Statut :</strong> Vous pouvez maintenant modifier le statut du don selon son évolution :
                            </p>
                            <ul class="small">
                                <li><strong>En attente :</strong> Don reçu, en attente d'attribution</li>
                                <li><strong>Attribué :</strong> Don affecté à une ou plusieurs villes</li>
                                <li><strong>Distribué :</strong> Don complètement distribué aux bénéficiaires</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-custom mt-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-lightbulb text-warning"></i> Conseil
                            </h5>
                            <p class="card-text">
                                Mettez à jour le statut du don après chaque attribution ou distribution. Cela garantit une meilleure traçabilité des dons.
                            </p>
                        </div>
                    </div>

                    <div class="card shadow-custom mt-3 bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Historique des modifications</h6>
                            <small class="text-muted">
                                <i class="bi bi-clock-history"></i> Créé le : 15/02/2026<br>
                                <i class="bi bi-pencil"></i> Dernière modification : 15/02/2026
                            </small>
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
        });
    </script>
</body>
</html>
