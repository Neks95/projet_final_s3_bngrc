<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Attribution - BNGRC</title>
    
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
                    <li class="breadcrumb-item active">Ajouter</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Ajouter une Attribution</h1>
                <p class="text-muted">Attribuer un don à une ville sinistrée</p>
            </div>

            <!-- Formulaire -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-container">
                        <form id="addAttributionForm" onsubmit="handleAddForm(event, 'attribution')">
                            <div class="mb-3">
                                <label for="don" class="form-label">
                                    Sélectionner un Don Disponible <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="don" name="don" required>
                                    <option value="">Choisir un don...</option>
                                    <option value="1" data-type="Don financier" data-quantite="1" data-unite="" data-donateur="M. Rakoto Jean">Don financier - 5 000 000 Ar - M. Rakoto Jean (En attente)</option>
                                    <option value="2" data-type="Haricots" data-quantite="400" data-unite="kg" data-donateur="Mme Ravao Soanirina">Haricots - 400 kg - Mme Ravao Soanirina (En attente)</option>
                                    <option value="3" data-type="Sucre" data-quantite="300" data-unite="kg" data-donateur="M. Andria Paul">Sucre - 300 kg - M. Andria Paul (En attente)</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner un don disponible.
                                </div>
                            </div>

                            <!-- Détails du don sélectionné -->
                            <div id="donDetails" class="alert alert-info d-none mb-3">
                                <h6 class="alert-heading"><i class="bi bi-info-circle"></i> Détails du Don</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Type:</strong> <span id="donType">-</span><br>
                                        <strong>Quantité disponible:</strong> <span id="donQuantite">-</span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Donateur:</strong> <span id="donDonateur">-</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="ville" class="form-label">
                                    Ville Bénéficiaire <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="ville" name="ville" required>
                                    <option value="">Sélectionner une ville...</option>
                                    <option value="Toamasina">Toamasina</option>
                                    <option value="Mananjary">Mananjary</option>
                                    <option value="Mahanoro">Mahanoro</option>
                                    <option value="Vatomandry">Vatomandry</option>
                                    <option value="Antalaha">Antalaha</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une ville bénéficiaire.
                                </div>
                            </div>

                            <!-- Besoins de la ville pour ce type -->
                            <div id="villeBesoins" class="alert alert-warning d-none mb-3">
                                <h6 class="alert-heading"><i class="bi bi-exclamation-triangle"></i> Besoins de la Ville</h6>
                                <p class="mb-0"><strong><span id="villeNom">-</span></strong> a besoin de <strong><span id="besoinQuantite">-</span></strong> pour <strong><span id="besoinType">-</span></strong></p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantite" class="form-label">
                                        Quantité à Attribuer <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" class="form-control" id="quantite" name="quantite" required min="0.01" step="0.01" placeholder="Ex: 300">
                                    <div class="form-text">Maximum: <span id="maxQuantite">-</span></div>
                                    <div class="invalid-feedback">
                                        Veuillez saisir une quantité valide (max: <span id="maxQuantiteFeedback">-</span>).
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="date_attribution" class="form-label">
                                        Date d'Attribution <span class="text-danger">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="date_attribution" name="date_attribution" required>
                                    <div class="invalid-feedback">
                                        Veuillez sélectionner une date.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">
                                    Notes (optionnel)
                                </label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Informations complémentaires sur l'attribution..."></textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="attributions.html" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Enregistrer l'Attribution
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Aide -->
                <div class="col-lg-4">
                    <div class="card shadow-custom help-card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0"><i class="bi bi-question-circle"></i> Aide</h5>
                        </div>
                        <div class="card-body">
                            <h6>Attribution d'un Don</h6>
                            <p class="small">L'attribution permet d'affecter un don disponible à une ville sinistrée ayant des besoins.</p>
                            
                            <h6 class="mt-3">Points importants :</h6>
                            <ul class="small">
                                <li>Seuls les dons <strong>"En attente"</strong> peuvent être attribués</li>
                                <li>La quantité attribuée ne peut pas dépasser la quantité disponible</li>
                                <li>Une attribution peut couvrir tout ou partie du besoin d'une ville</li>
                                <li>Le système affiche automatiquement les besoins de la ville pour le type de don sélectionné</li>
                            </ul>

                            <h6 class="mt-3">Validation :</h6>
                            <ul class="small">
                                <li>Tous les champs avec <span class="text-danger">*</span> sont obligatoires</li>
                                <li>La quantité doit être positive</li>
                                <li>La date ne peut pas être dans le futur</li>
                            </ul>
                        </div>
                    </div>

                    <div class="card shadow-custom mt-3">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="bi bi-lightbulb"></i> Conseil</h6>
                        </div>
                        <div class="card-body">
                            <p class="small mb-0">Consultez la page <a href="simulation.html">Simulation</a> pour obtenir des recommandations d'attribution optimales basées sur les priorités et les besoins.</p>
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
    
    <!-- Scripts spécifiques -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Définir la date d'aujourd'hui par défaut
            const dateInput = document.getElementById('date_attribution');
            const today = new Date().toISOString().split('T')[0];
            dateInput.value = today;
            dateInput.max = today;

            // Gérer le changement de don sélectionné
            const donSelect = document.getElementById('don');
            const donDetails = document.getElementById('donDetails');
            const quantiteInput = document.getElementById('quantite');
            
            donSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                
                if (this.value) {
                    // Afficher les détails du don
                    const type = selectedOption.getAttribute('data-type');
                    const quantite = selectedOption.getAttribute('data-quantite');
                    const unite = selectedOption.getAttribute('data-unite');
                    const donateur = selectedOption.getAttribute('data-donateur');
                    
                    document.getElementById('donType').textContent = type;
                    document.getElementById('donQuantite').textContent = quantite + ' ' + unite;
                    document.getElementById('donDonateur').textContent = donateur;
                    document.getElementById('maxQuantite').textContent = quantite + ' ' + unite;
                    document.getElementById('maxQuantiteFeedback').textContent = quantite + ' ' + unite;
                    
                    donDetails.classList.remove('d-none');
                    
                    // Définir le maximum pour la quantité
                    quantiteInput.max = quantite;
                    
                    // Vérifier les besoins de la ville si une ville est sélectionnée
                    checkVilleBesoins();
                } else {
                    donDetails.classList.add('d-none');
                    document.getElementById('villeBesoins').classList.add('d-none');
                }
            });

            // Gérer le changement de ville sélectionnée
            const villeSelect = document.getElementById('ville');
            villeSelect.addEventListener('change', checkVilleBesoins);

            function checkVilleBesoins() {
                const donSelect = document.getElementById('don');
                const villeSelect = document.getElementById('ville');
                const villeBesoins = document.getElementById('villeBesoins');
                
                if (donSelect.value && villeSelect.value) {
                    const selectedOption = donSelect.options[donSelect.selectedIndex];
                    const type = selectedOption.getAttribute('data-type');
                    const ville = villeSelect.value;
                    
                    // Simuler les besoins (dans une vraie application, cela viendrait d'une API)
                    const besoins = {
                        'Toamasina': { 'Riz': '500 kg', 'Huile': '200 L', 'Tôle': '100 unités', 'Ciment': '150 sacs' },
                        'Mananjary': { 'Riz': '300 kg', 'Huile': '150 L', 'Eau potable': '800 L', 'Tôle': '80 unités' },
                        'Mahanoro': { 'Riz': '400 kg', 'Tôle': '120 unités', 'Ciment': '100 sacs' },
                        'Vatomandry': { 'Riz': '250 kg', 'Huile': '100 L', 'Tôle': '60 unités' },
                        'Antalaha': { 'Riz': '350 kg', 'Huile': '120 L', 'Ciment': '80 sacs', 'Eau potable': '500 L' }
                    };
                    
                    if (besoins[ville] && besoins[ville][type]) {
                        document.getElementById('villeNom').textContent = ville;
                        document.getElementById('besoinType').textContent = type;
                        document.getElementById('besoinQuantite').textContent = besoins[ville][type];
                        villeBesoins.classList.remove('d-none');
                    } else {
                        villeBesoins.classList.add('d-none');
                    }
                }
            }

            // Validation de la quantité en temps réel
            quantiteInput.addEventListener('input', function() {
                const max = parseFloat(this.max);
                const value = parseFloat(this.value);
                
                if (value > max) {
                    this.setCustomValidity('La quantité ne peut pas dépasser ' + max);
                } else if (value <= 0) {
                    this.setCustomValidity('La quantité doit être positive');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    </script>
</body>
</html>
