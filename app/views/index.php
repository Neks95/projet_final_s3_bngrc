<?php 
$base = Flight::get('flight.base_url'); 

$page_title = "Dashboard - BNGRC";

// Définir le contenu directement avec ob_start/ob_get_clean
ob_start();
?>
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>