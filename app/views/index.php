<?php 
$base = Flight::get('flight.base_url'); 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BNGRC Gestion des Dons</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= $base ?>css/style.css">
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
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>simulation">Simulation</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>rapports">Rapports</a></li>
                    </ul>
                    <div class="ms-3 text-white small" id="current-datetime"></div>
                </div>
            </div>
        </nav>
    </header>


<!-- ================= MAIN ================= -->
<main class="main-content">
<div class="container">

    <!-- TITRE -->
    <div class="mb-4">
        <h1 class="display-5 fw-bold text-primary-custom">Tableau de Bord</h1>
        <p class="text-muted">Vue d'ensemble de la gestion des dons</p>
    </div>

    <!-- ================= STATISTIQUES ================= -->
    <div class="row g-4 mb-4">

        <!-- VILLES -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card">
                <div class="card-body text-center">
                    <div class="stat-icon bg-primary text-white">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="stat-value">
                        <?= $nbVille['total'] ?>
                    </div>
                    <div class="stat-label">Villes Affectées</div>
                </div>
            </div>
        </div>

        <!-- BESOINS -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card">
                <div class="card-body text-center">
                    <div class="stat-icon bg-warning text-white">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value">
                        <?= number_format($totalBesoins['total'] ?? 0, 0, ',', ' ') ?> Ar
                    </div>
                    <div class="stat-label">Besoins Totaux</div>
                </div>
            </div>
        </div>

        <!-- DONS -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card">
                <div class="card-body text-center">
                    <div class="stat-icon bg-success text-white">
                        <i class="bi bi-gift"></i>
                    </div>
                    <div class="stat-value">
                        <?= number_format($totalDons['total'] ?? 0, 0, ',', ' ') ?> Ar
                    </div>
                    <div class="stat-label">Dons Collectés</div>
                </div>
            </div>
        </div>

    </div>

    <!-- ================= TABLEAU PAR VILLE ================= -->
    <div class="table-container">
        <h3 class="h4 mb-3">Récapitulatif par Ville</h3>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Ville</th>
                        <th>Besoins Totaux</th>
                        <th>Dons Attribués</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($recapVille as $ville): ?>
                    <tr>
                        <td><strong><?= $ville['nom'] ?></strong></td>
                        <td><?= number_format($ville['total_besoin'] ?? 0, 0, ',', ' ') ?> Ar</td>
                        <td><?= number_format($ville['total_attribue'] ?? 0, 0, ',', ' ') ?> Ar</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= ACTIVITES ================= -->
    <div class="row g-4 mt-4">

        <!-- DERNIERS DONS -->
        <div class="col-lg-6">
            <div class="activity-list">
                <h4 class="mb-3">Derniers Dons</h4>

                <?php foreach($lastDons as $don): ?>
                <div class="activity-item">
                    <strong><?= $don['nom_type'] ?></strong>
                    <div class="text-muted"><?= $don['qte'] ?> unités</div>
                    <span class="badge bg-success">
                        <?= number_format($don['qte'] * $don['prix_unitaire'], 0, ',', ' ') ?> Ar
                    </span>
                    <div class="activity-date">
                        <?= date('d/m/Y', strtotime($don['date_saisie'])) ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <!-- DERNIERES ATTRIBUTIONS -->
        <div class="col-lg-6">
            <div class="activity-list">
                <h4 class="mb-3">Dernières Attributions</h4>

                <?php foreach($lastAttrib as $a): ?>
                <div class="activity-item">
                    <strong><?= $a['ville'] ?></strong>
                    <div class="text-muted"><?= $a['qte'] ?> <?= $a['nom_type'] ?></div>
                    <span class="badge bg-info">
                        <?= number_format($a['qte'] * $a['prix_unitaire'], 0, ',', ' ') ?> Ar
                    </span>
                    <div class="activity-date">
                        <?= date('d/m/Y', strtotime($a['date_mvt'])) ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>

</div>
</main>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
    <div class="container">
        <h5>BNGRC</h5>
        <p>Bureau National de Gestion des Risques et des Catastrophes</p>
        <p>&copy; 2026 BNGRC. Tous droits réservés.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
