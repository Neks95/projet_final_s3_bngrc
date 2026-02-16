<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports et Statistiques - BNGRC Gestion des Dons</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    
    <style>
        .report-section {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .report-section h3 {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        
        .category-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-top: 4px solid;
            height: 100%;
        }
        
        .category-card.nature { border-color: #198754; }
        .category-card.materiaux { border-color: #fd7e14; }
        .category-card.argent { border-color: #ffc107; }
        
        .category-stat {
            margin: 15px 0;
        }
        
        .category-stat label {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .category-stat .value {
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .badge-gold {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #000;
        }
        
        .badge-silver {
            background: linear-gradient(135deg, #c0c0c0, #e8e8e8);
            color: #000;
        }
        
        .badge-bronze {
            background: linear-gradient(135deg, #cd7f32, #e9b880);
            color: #fff;
        }
        
        .coverage-high {
            color: #198754;
            font-weight: bold;
        }
        
        .coverage-medium {
            color: #ffc107;
            font-weight: bold;
        }
        
        .coverage-low {
            color: #dc3545;
            font-weight: bold;
        }
        
        .export-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        
        .date-filter {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        
        .chart-wrapper {
            position: relative;
            height: 300px;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
            
            .report-section {
                page-break-inside: avoid;
            }
            
            body {
                background: white;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="site-header no-print">
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
                            <a class="nav-link active" href="rapports.html">Rapports</a>
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
            <nav aria-label="breadcrumb" class="no-print">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Rapports et Statistiques</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Rapports et Statistiques</h1>
                <p class="text-muted">Analyse complète de la gestion des dons et des besoins</p>
            </div>

            <!-- Date Filter -->
            <div class="date-filter no-print">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date de début</label>
                        <input type="date" class="form-control" id="dateDebut" value="2026-01-01">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Date de fin</label>
                        <input type="date" class="form-control" id="dateFin" value="2026-02-28">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100" id="applyFilter">
                            <i class="bi bi-funnel"></i> Appliquer le filtre
                        </button>
                    </div>
                </div>
            </div>

            <!-- A. Rapport par Ville -->
            <div class="report-section">
                <h3><i class="bi bi-geo-alt"></i> A. Rapport par Ville</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ville</th>
                                <th>Besoins Totaux</th>
                                <th>Dons Reçus</th>
                                <th>Taux de Couverture</th>
                                <th>Indicateur</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Toamasina</strong></td>
                                <td>12 500 000 Ar</td>
                                <td>8 900 000 Ar</td>
                                <td><span class="coverage-medium">71%</span></td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-warning" style="width: 71%">71%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mananjary</strong></td>
                                <td>11 200 000 Ar</td>
                                <td>7 450 000 Ar</td>
                                <td><span class="coverage-medium">67%</span></td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-warning" style="width: 67%">67%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Mahanoro</strong></td>
                                <td>8 900 000 Ar</td>
                                <td>5 340 000 Ar</td>
                                <td><span class="coverage-medium">60%</span></td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-warning" style="width: 60%">60%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Vatomandry</strong></td>
                                <td>7 580 000 Ar</td>
                                <td>4 200 000 Ar</td>
                                <td><span class="coverage-low">55%</span></td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-danger" style="width: 55%">55%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Brickaville</strong></td>
                                <td>5 500 000 Ar</td>
                                <td>2 000 000 Ar</td>
                                <td><span class="coverage-low">36%</span></td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-danger" style="width: 36%">36%</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <td><strong>TOTAL</strong></td>
                                <td><strong>45 680 000 Ar</strong></td>
                                <td><strong>27 890 000 Ar</strong></td>
                                <td><strong><span class="coverage-medium">61%</span></strong></td>
                                <td>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-primary" style="width: 61%">61%</div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- B. Rapport par Catégorie -->
            <div class="report-section">
                <h3><i class="bi bi-pie-chart"></i> B. Rapport par Catégorie</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="category-card nature">
                            <h4><i class="bi bi-basket"></i> Nature</h4>
                            <div class="category-stat">
                                <label>Besoins totaux</label>
                                <div class="value text-success">18 900 000 Ar</div>
                            </div>
                            <div class="category-stat">
                                <label>Dons reçus</label>
                                <div class="value text-success">12 450 000 Ar</div>
                            </div>
                            <div class="category-stat">
                                <label>Taux de couverture</label>
                                <div class="value text-success">66%</div>
                            </div>
                            <div class="chart-wrapper mt-3">
                                <canvas id="chartNature"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="category-card materiaux">
                            <h4><i class="bi bi-tools"></i> Matériaux</h4>
                            <div class="category-stat">
                                <label>Besoins totaux</label>
                                <div class="value text-warning">21 780 000 Ar</div>
                            </div>
                            <div class="category-stat">
                                <label>Dons reçus</label>
                                <div class="value text-warning">12 940 000 Ar</div>
                            </div>
                            <div class="category-stat">
                                <label>Taux de couverture</label>
                                <div class="value text-warning">59%</div>
                            </div>
                            <div class="chart-wrapper mt-3">
                                <canvas id="chartMateriaux"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="category-card argent">
                            <h4><i class="bi bi-cash"></i> Argent</h4>
                            <div class="category-stat">
                                <label>Besoins totaux</label>
                                <div class="value" style="color: #ffc107;">5 000 000 Ar</div>
                            </div>
                            <div class="category-stat">
                                <label>Dons reçus</label>
                                <div class="value" style="color: #ffc107;">2 500 000 Ar</div>
                            </div>
                            <div class="category-stat">
                                <label>Taux de couverture</label>
                                <div class="value" style="color: #ffc107;">50%</div>
                            </div>
                            <div class="chart-wrapper mt-3">
                                <canvas id="chartArgent"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- C. Rapport des Donateurs -->
            <div class="report-section">
                <h3><i class="bi bi-people"></i> C. Rapport des Donateurs</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Rang</th>
                                <th>Donateur</th>
                                <th>Nombre de Dons</th>
                                <th>Valeur Totale</th>
                                <th>Article Principal</th>
                                <th>Badge</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-warning">🥇 1</span></td>
                                <td><strong>ONG Croix Rouge</strong></td>
                                <td>15</td>
                                <td>8 500 000 Ar</td>
                                <td>Riz (2500 kg)</td>
                                <td><span class="badge badge-gold">🏆 Or</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-secondary">🥈 2</span></td>
                                <td><strong>Entreprise STAR</strong></td>
                                <td>12</td>
                                <td>6 800 000 Ar</td>
                                <td>Huile (800 L)</td>
                                <td><span class="badge badge-silver">🥈 Argent</span></td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-dark">🥉 3</span></td>
                                <td><strong>Association Vatosoa</strong></td>
                                <td>10</td>
                                <td>5 200 000 Ar</td>
                                <td>Tôles (400 unités)</td>
                                <td><span class="badge badge-bronze">🥉 Bronze</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><strong>Fondation Akbaraly</strong></td>
                                <td>8</td>
                                <td>4 100 000 Ar</td>
                                <td>Don financier</td>
                                <td><span class="badge bg-info">Contributeur</span></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><strong>Lions Club Madagascar</strong></td>
                                <td>7</td>
                                <td>3 450 000 Ar</td>
                                <td>Médicaments</td>
                                <td><span class="badge bg-info">Contributeur</span></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><strong>Rotary Club Antananarivo</strong></td>
                                <td>6</td>
                                <td>2 900 000 Ar</td>
                                <td>Couvertures (500)</td>
                                <td><span class="badge bg-info">Contributeur</span></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><strong>M. Rakoto Jean</strong></td>
                                <td>5</td>
                                <td>2 100 000 Ar</td>
                                <td>Don financier</td>
                                <td><span class="badge bg-info">Contributeur</span></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><strong>Caritas Madagascar</strong></td>
                                <td>5</td>
                                <td>1 850 000 Ar</td>
                                <td>Vêtements (800)</td>
                                <td><span class="badge bg-info">Contributeur</span></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><strong>Banque BNI</strong></td>
                                <td>4</td>
                                <td>1 500 000 Ar</td>
                                <td>Don financier</td>
                                <td><span class="badge bg-info">Contributeur</span></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><strong>Orange Madagascar</strong></td>
                                <td>3</td>
                                <td>1 200 000 Ar</td>
                                <td>Kits scolaires (200)</td>
                                <td><span class="badge bg-info">Contributeur</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- D. Évolution Temporelle -->
            <div class="report-section">
                <h3><i class="bi bi-graph-up-arrow"></i> D. Évolution Temporelle</h3>
                <p class="text-muted mb-4">Évolution des dons et attributions sur la période sélectionnée</p>
                <div style="position: relative; height: 400px;">
                    <canvas id="chartEvolution"></canvas>
                </div>
            </div>

            <!-- Export Buttons -->
            <div class="export-buttons no-print">
                <button class="btn btn-danger btn-lg" id="exportPDF">
                    <i class="bi bi-file-pdf"></i> Télécharger PDF
                </button>
                <button class="btn btn-success btn-lg" id="exportExcel">
                    <i class="bi bi-file-excel"></i> Exporter Excel
                </button>
                <button class="btn btn-primary btn-lg" id="printReport">
                    <i class="bi bi-printer"></i> Imprimer
                </button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer no-print">
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
    
    <!-- Reports Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Charts
            
            // Nature Category Pie Chart
            new Chart(document.getElementById('chartNature'), {
                type: 'doughnut',
                data: {
                    labels: ['Reçus', 'Manquants'],
                    datasets: [{
                        data: [66, 34],
                        backgroundColor: ['#198754', '#e9ecef'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Matériaux Category Pie Chart
            new Chart(document.getElementById('chartMateriaux'), {
                type: 'doughnut',
                data: {
                    labels: ['Reçus', 'Manquants'],
                    datasets: [{
                        data: [59, 41],
                        backgroundColor: ['#fd7e14', '#e9ecef'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Argent Category Pie Chart
            new Chart(document.getElementById('chartArgent'), {
                type: 'doughnut',
                data: {
                    labels: ['Reçus', 'Manquants'],
                    datasets: [{
                        data: [50, 50],
                        backgroundColor: ['#ffc107', '#e9ecef'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Evolution Temporelle Line Chart
            new Chart(document.getElementById('chartEvolution'), {
                type: 'line',
                data: {
                    labels: ['01/01', '05/01', '10/01', '15/01', '20/01', '25/01', '01/02', '05/02', '10/02', '15/02', '20/02', '28/02'],
                    datasets: [
                        {
                            label: 'Dons Reçus (en milliers Ar)',
                            data: [500, 1200, 2100, 3500, 5200, 7800, 10500, 14200, 18900, 22400, 25800, 27890],
                            borderColor: '#198754',
                            backgroundColor: 'rgba(25, 135, 84, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Attributions (en milliers Ar)',
                            data: [0, 300, 800, 1500, 2800, 4200, 6500, 9200, 12800, 16500, 20100, 23400],
                            borderColor: '#0d6efd',
                            backgroundColor: 'rgba(13, 110, 253, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString() + ' Ar';
                                }
                            }
                        }
                    }
                }
            });

            // Export Buttons
            document.getElementById('exportPDF').addEventListener('click', function() {
                alert('📄 Génération du rapport PDF en cours...\n\n' +
                      'Le fichier "rapport-bngrc-' + new Date().toISOString().split('T')[0] + '.pdf" ' +
                      'sera téléchargé dans quelques instants.\n\n' +
                      '(Cette fonctionnalité sera implémentée dans la version finale)');
            });

            document.getElementById('exportExcel').addEventListener('click', function() {
                alert('📊 Exportation Excel en cours...\n\n' +
                      'Le fichier "rapport-bngrc-' + new Date().toISOString().split('T')[0] + '.xlsx" ' +
                      'sera téléchargé dans quelques instants.\n\n' +
                      '(Cette fonctionnalité sera implémentée dans la version finale)');
            });

            document.getElementById('printReport').addEventListener('click', function() {
                window.print();
            });

            document.getElementById('applyFilter').addEventListener('click', function() {
                const dateDebut = document.getElementById('dateDebut').value;
                const dateFin = document.getElementById('dateFin').value;
                
                alert('🔍 Application du filtre...\n\n' +
                      'Période : ' + dateDebut + ' au ' + dateFin + '\n\n' +
                      'Les données affichées seront mises à jour selon la période sélectionnée.\n\n' +
                      '(Cette fonctionnalité sera implémentée dans la version finale)');
            });
        });
    </script>
</body>
</html>
