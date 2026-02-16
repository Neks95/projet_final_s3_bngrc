<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulation de Dispatch - BNGRC Gestion des Dons</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <style>
        .algorithm-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .algorithm-steps {
            list-style: none;
            padding-left: 0;
        }
        
        .algorithm-steps li {
            padding: 10px 0;
            padding-left: 35px;
            position: relative;
        }
        
        .algorithm-steps li:before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 10px;
            background: rgba(255,255,255,0.3);
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .config-panel {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .simulation-results {
            display: none;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .summary-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 4px solid;
            transition: transform 0.3s;
        }
        
        .summary-card:hover {
            transform: translateY(-5px);
        }
        
        .summary-card.processed { border-color: #0d6efd; }
        .summary-card.matched { border-color: #198754; }
        .summary-card.remaining { border-color: #dc3545; }
        .summary-card.coverage { border-color: #ffc107; }
        
        .summary-value {
            font-size: 2rem;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .summary-label {
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .simulation-step {
            animation: slideIn 0.5s;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        .status-success {
            color: #198754;
            font-weight: bold;
        }
        
        .status-partial {
            color: #fd7e14;
            font-weight: bold;
        }
        
        .status-pending {
            color: #6c757d;
            font-weight: bold;
        }
        
        .coverage-bar {
            height: 30px;
            background: #e9ecef;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            margin: 20px 0;
        }
        
        .coverage-fill {
            height: 100%;
            background: linear-gradient(90deg, #198754 0%, #20c997 100%);
            transition: width 2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .radio-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= $base ?>/">
                    <div class="logo">BNGRC</div>
                    <span>Gestion des Dons</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="<?= $base ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= $base ?>villes">Villes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>besoins">Besoins</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>dons">Dons</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>attributions">Attributions</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>dispatch">Simulation</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>rapports">Rapports</a></li>
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
                    <li class="breadcrumb-item active">Simulation de Dispatch</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Simulation de Dispatch Automatique</h1>
                <p class="text-muted">Attribution par ordre de date de saisie des besoins</p>
            </div>

            <!-- Algorithm Explanation -->
            <div class="algorithm-card">
                <h3 class="mb-3"><i class="bi bi-lightbulb"></i> Comment fonctionne l'algorithme ?</h3>
                <p class="mb-3">Le système d'attribution automatique optimise la distribution des dons selon les critères suivants :</p>
                <ul class="algorithm-steps">
                    <li><strong>Traitement chronologique :</strong> Les besoins sont traités par ordre de date de saisie (les plus anciens en premier)</li>
                    <li><strong>Correspondance automatique :</strong> Pour chaque besoin, le système recherche les dons disponibles correspondants</li>
                    <li><strong>Attribution prioritaire :</strong> Système "premier arrivé, premier servi" garantissant l'équité</li>
                    <li><strong>Gestion partielle :</strong> Si un don est insuffisant, une attribution partielle est créée et le reste du besoin continue d'être traité</li>
                </ul>
            </div>

            <!-- Configuration Panel -->
            <div class="config-panel">
                <h4 class="mb-4"><i class="bi bi-gear"></i> Configuration de la Simulation</h4>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Prioriser par :</label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="priorityDate" name="priority" value="date" checked class="form-check-input">
                                <label for="priorityDate" class="form-check-label">Date</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="priorityCity" name="priority" value="city" class="form-check-input">
                                <label for="priorityCity" class="form-check-label">Ville</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="priorityCategory" name="priority" value="category" class="form-check-input">
                                <label for="priorityCategory" class="form-check-label">Catégorie</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Inclure :</label>
                        <div class="form-check">
                            <input type="checkbox" id="includeAll" class="form-check-input">
                            <label for="includeAll" class="form-check-label">Tous les dons (y compris déjà attribués)</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="includeWaiting" class="form-check-input" checked>
                            <label for="includeWaiting" class="form-check-label">Uniquement dons "En attente"</label>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button class="btn btn-primary btn-lg" id="startSimulation">
                        <i class="bi bi-play-circle"></i> Démarrer la Simulation
                    </button>
                </div>
            </div>

            <!-- Results Section -->
            <div id="simulationResults" class="simulation-results">
                <h3 class="mb-4"><i class="bi bi-graph-up"></i> Résultats de la Simulation</h3>
                
                <!-- Summary Cards -->
                <div class="summary-cards">
                    <div class="summary-card processed">
                        <i class="bi bi-list-check" style="font-size: 2rem; color: #0d6efd;"></i>
                        <div class="summary-value" id="totalProcessed">12</div>
                        <div class="summary-label">Besoins Traités</div>
                    </div>
                    <div class="summary-card matched">
                        <i class="bi bi-check-circle" style="font-size: 2rem; color: #198754;"></i>
                        <div class="summary-value" id="totalMatched">8</div>
                        <div class="summary-label">Correspondances Réussies</div>
                    </div>
                    <div class="summary-card remaining">
                        <i class="bi bi-exclamation-circle" style="font-size: 2rem; color: #dc3545;"></i>
                        <div class="summary-value" id="totalRemaining">4</div>
                        <div class="summary-label">Besoins Restants</div>
                    </div>
                    <div class="summary-card coverage">
                        <i class="bi bi-percent" style="font-size: 2rem; color: #ffc107;"></i>
                        <div class="summary-value" id="coverageRate">67%</div>
                        <div class="summary-label">Taux de Couverture</div>
                    </div>
                </div>

                <!-- Coverage Progress Bar -->
                <div class="coverage-bar">
                    <div class="coverage-fill" id="coverageFill" style="width: 0%;">
                        <span id="coverageText">0%</span>
                    </div>
                </div>

                <!-- Simulation Steps Table -->
                <div class="table-container">
                    <h4 class="mb-3">Étapes de la Simulation</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Étape</th>
                                    <th>Besoin</th>
                                    <th>Ville</th>
                                    <th>Type</th>
                                    <th>Quantité</th>
                                    <th>Don Disponible</th>
                                    <th>Attribution</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody id="simulationSteps">
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#1</span></td>
                                    <td>Besoin #001</td>
                                    <td>Toamasina</td>
                                    <td>Riz</td>
                                    <td>500 kg</td>
                                    <td>Don #012 - 800 kg</td>
                                    <td>500 kg attribués</td>
                                    <td><span class="status-success"><i class="bi bi-check-circle"></i> Complet</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#2</span></td>
                                    <td>Besoin #003</td>
                                    <td>Mananjary</td>
                                    <td>Huile</td>
                                    <td>200 L</td>
                                    <td>Don #015 - 200 L</td>
                                    <td>200 L attribués</td>
                                    <td><span class="status-success"><i class="bi bi-check-circle"></i> Complet</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#3</span></td>
                                    <td>Besoin #005</td>
                                    <td>Mahanoro</td>
                                    <td>Tôles</td>
                                    <td>100 unités</td>
                                    <td>Don #018 - 60 unités</td>
                                    <td>60 unités attribuées</td>
                                    <td><span class="status-partial"><i class="bi bi-exclamation-triangle"></i> Partiel</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#4</span></td>
                                    <td>Besoin #007</td>
                                    <td>Vatomandry</td>
                                    <td>Couvertures</td>
                                    <td>300 unités</td>
                                    <td>Don #020 - 300 unités</td>
                                    <td>300 unités attribuées</td>
                                    <td><span class="status-success"><i class="bi bi-check-circle"></i> Complet</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#5</span></td>
                                    <td>Besoin #009</td>
                                    <td>Brickaville</td>
                                    <td>Don financier</td>
                                    <td>2 000 000 Ar</td>
                                    <td>Don #022 - 2 500 000 Ar</td>
                                    <td>2 000 000 Ar attribués</td>
                                    <td><span class="status-success"><i class="bi bi-check-circle"></i> Complet</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#6</span></td>
                                    <td>Besoin #010</td>
                                    <td>Toamasina</td>
                                    <td>Médicaments</td>
                                    <td>50 kits</td>
                                    <td>Don #024 - 50 kits</td>
                                    <td>50 kits attribués</td>
                                    <td><span class="status-success"><i class="bi bi-check-circle"></i> Complet</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#7</span></td>
                                    <td>Besoin #012</td>
                                    <td>Mananjary</td>
                                    <td>Riz</td>
                                    <td>400 kg</td>
                                    <td>Don #012 - 300 kg restants</td>
                                    <td>300 kg attribués</td>
                                    <td><span class="status-partial"><i class="bi bi-exclamation-triangle"></i> Partiel</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#8</span></td>
                                    <td>Besoin #014</td>
                                    <td>Mahanoro</td>
                                    <td>Vêtements</td>
                                    <td>500 unités</td>
                                    <td>Don #026 - 500 unités</td>
                                    <td>500 unités attribuées</td>
                                    <td><span class="status-success"><i class="bi bi-check-circle"></i> Complet</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#9</span></td>
                                    <td>Besoin #016</td>
                                    <td>Vatomandry</td>
                                    <td>Bidons d'eau</td>
                                    <td>200 L</td>
                                    <td>Aucun don disponible</td>
                                    <td>0 L attribués</td>
                                    <td><span class="status-pending"><i class="bi bi-hourglass-split"></i> En attente</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#10</span></td>
                                    <td>Besoin #018</td>
                                    <td>Brickaville</td>
                                    <td>Tôles</td>
                                    <td>80 unités</td>
                                    <td>Don #028 - 100 unités</td>
                                    <td>80 unités attribuées</td>
                                    <td><span class="status-success"><i class="bi bi-check-circle"></i> Complet</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#11</span></td>
                                    <td>Besoin #020</td>
                                    <td>Toamasina</td>
                                    <td>Kits scolaires</td>
                                    <td>150 unités</td>
                                    <td>Aucun don disponible</td>
                                    <td>0 unités attribuées</td>
                                    <td><span class="status-pending"><i class="bi bi-hourglass-split"></i> En attente</span></td>
                                </tr>
                                <tr class="simulation-step">
                                    <td><span class="badge bg-primary">#12</span></td>
                                    <td>Besoin #022</td>
                                    <td>Mananjary</td>
                                    <td>Ustensiles cuisine</td>
                                    <td>100 sets</td>
                                    <td>Aucun don disponible</td>
                                    <td>0 sets attribués</td>
                                    <td><span class="status-pending"><i class="bi bi-hourglass-split"></i> En attente</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4 d-flex gap-3 justify-content-center">
                    <button class="btn btn-success btn-lg" id="executeAttributions">
                        <i class="bi bi-check2-all"></i> Exécuter les Attributions
                    </button>
                    <button class="btn btn-secondary btn-lg" id="resetSimulation">
                        <i class="bi bi-arrow-clockwise"></i> Réinitialiser la Simulation
                    </button>
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
    
    <!-- Simulation Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startBtn = document.getElementById('startSimulation');
            const resetBtn = document.getElementById('resetSimulation');
            const executeBtn = document.getElementById('executeAttributions');
            const resultsDiv = document.getElementById('simulationResults');
            const coverageFill = document.getElementById('coverageFill');
            const coverageText = document.getElementById('coverageText');

            startBtn.addEventListener('click', function() {
                // Show results with animation
                resultsDiv.style.display = 'block';
                
                // Animate coverage bar
                setTimeout(() => {
                    coverageFill.style.width = '67%';
                    coverageText.textContent = '67%';
                }, 300);

                // Scroll to results
                resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'start' });

                // Update button
                startBtn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Relancer la Simulation';
            });

            resetBtn.addEventListener('click', function() {
                // Reset coverage bar
                coverageFill.style.width = '0%';
                coverageText.textContent = '0%';
                
                // Hide results
                resultsDiv.style.display = 'none';
                
                // Reset button
                startBtn.innerHTML = '<i class="bi bi-play-circle"></i> Démarrer la Simulation';
                
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            executeBtn.addEventListener('click', function() {
                if (confirm('Voulez-vous vraiment créer ces attributions ? Cette action créera ' + 
                           '8 nouvelles attributions dans le système.')) {
                    // Simulate execution
                    executeBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Exécution en cours...';
                    executeBtn.disabled = true;
                    
                    setTimeout(() => {
                        alert('✓ Succès ! 8 attributions ont été créées avec succès.\n\n' +
                              'Redirection vers la page des attributions...');
                        window.location.href = 'attributions.html';
                    }, 2000);
                }
            });

            // Checkbox logic
            document.getElementById('includeAll').addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('includeWaiting').checked = false;
                }
            });

            document.getElementById('includeWaiting').addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById('includeAll').checked = false;
                }
            });
        });
    </script>
</body>
</html>
