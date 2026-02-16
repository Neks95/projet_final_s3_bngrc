<?php
$base_url = Flight::get('flight.base_url'); 
?>

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
    <link rel="stylesheet" href="<?= $base_url ?>css/style.css">
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
                <a href="<?= $base_url ?>ajout_don" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter un Don
                </a>
            </div>
            <!-- Tableau des dons -->
            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0">Liste des Dons</h3>
                </div>

                <div class="table-responsive card p-3">
                    <table class="table table-hover table-sm align-middle" id="donsTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th class="text-end">Quantité</th>
                                <th>Unité</th>
                                <th class="text-end">Prix unitaire</th>
                                <th class="text-end">Montant total</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($don) && is_array($don)): ?>
                                <?php foreach ($don as $d):
                                    $id = isset($d['id']) ? (int)$d['id'] : 0;
                                    $qte = isset($d['qte']) ? (float)$d['qte'] : 0;
                                    $type = isset($d['nom_type']) ? htmlspecialchars($d['nom_type']) : '';
                                    $unite = isset($d['unite']) ? htmlspecialchars($d['unite']) : '';
                                    $prix = isset($d['prix_unitaire']) ? (float)$d['prix_unitaire'] : 0;
                                    $date = !empty($d['date_saisie']) ? date('d/m/Y', strtotime($d['date_saisie'])) : '';
                                    $montant = $qte * $prix;
                                ?>
                                    <tr>
                                        <td><?= $id ?></td>
                                        <td><?= $type ?></td>
                                        <td class="text-end"><?= number_format($qte, 0, ',', ' ') ?></td>
                                        <td><?= $unite ?></td>
                                        <td class="text-end"><?= number_format($prix, 0, ',', ' ') ?> Ar</td>
                                        <td class="text-end"><?= number_format($montant, 0, ',', ' ') ?> Ar</td>
                                        <td><?= $date ?></td>
                                        <td>
                                            <a href="don-modifier.php?id=<?= $id ?>" class="btn btn-sm btn-warning" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" onclick="handleDelete('don', <?= $id ?>)" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4">Aucun don enregistré.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div


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


</body>

</html>