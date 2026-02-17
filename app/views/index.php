<?php 
$base = Flight::get('flight.base_url'); 

$page_title = "Dashboard - BNGRC";

// Définir le contenu directement avec ob_start/ob_get_clean
ob_start();
?>
<main class="main-content">

    <div class="hero-section mb-5">
        <div class="hero-overlay">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold text-white mb-3">
                            <i class="bi bi-shield-check"></i> Bureau National de Gestion des Risques
                        </h1>
                        <p class="lead text-white-50 mb-4">
                            Coordination et gestion des dons pour les sinistrés de Madagascar
                        </p>
                        <div class="d-flex gap-3">
                            <a href="<?= $base ?>ajout_don" class="btn btn-primary btn-lg">
                                <i class="bi bi-gift"></i> Faire un Don
                            </a>
                            <a href="<?= $base ?>rapports" class="btn btn-outline-light btn-lg">
                                <i class="bi bi-graph-up"></i> Voir les Rapports
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="container">

    <div class="mb-4">
        <h2 class="h3 fw-bold text-primary-custom">
            <i class="bi bi-speedometer2"></i> Tableau de Bord
        </h2>
        <p class="text-muted">Vue d'ensemble en temps réel de la gestion des dons</p>
    </div>

    <div class="row g-4 mb-5">

        <!-- VILLES -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="stat-icon bg-primary text-white">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <div class="stat-value text-primary">
                        <?= $nbVille['total'] ?>
                    </div>
                    <div class="stat-label text-muted">Villes Affectées</div>
                </div>
            </div>
        </div>

        <!-- BESOINS -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="stat-icon bg-warning text-white">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="stat-value text-warning">
                        <?= number_format($totalBesoins['total'] ?? 0, 0, ',', ' ') ?> Ar
                    </div>
                    <div class="stat-label text-muted">Besoins Totaux</div>
                </div>
            </div>
        </div>

        <!-- DONS -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-card card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="stat-icon bg-success text-white">
                        <i class="bi bi-gift"></i>
                    </div>
                    <div class="stat-value text-success">
                        <?= number_format($totalDons['total'] ?? 0, 0, ',', ' ') ?> Ar
                    </div>
                    <div class="stat-label text-muted">Dons Collectés</div>
                </div>
            </div>
        </div>

        

    </div>

    <!-- ================= TABLEAU PAR VILLE ================= -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white border-0 pt-4">
            <h3 class="h5 mb-0">
                <i class="bi bi-table"></i> Récapitulatif par Ville
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-geo-alt-fill text-primary"></i> Ville</th>
                            <th class="text-end"><i class="bi bi-exclamation-circle text-warning"></i> Besoins Totaux</th>
                            <th class="text-end"><i class="bi bi-check-circle text-success"></i> Dons Attribués</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($recapVille as $ville): ?>
                        <?php 
                        $taux = $ville['total_besoin'] > 0 
                            ? round(($ville['total_attribue'] / $ville['total_besoin']) * 100) 
                            : 0;
                        ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($ville['nom']) ?></strong></td>
                            <td class="text-end"><?= number_format($ville['total_besoin'] ?? 0, 0, ',', ' ') ?> Ar</td>
                            <td class="text-end text-success"><?= number_format($ville['total_attribue'] ?? 0, 0, ',', ' ') ?> Ar</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">

        <!-- DERNIERS DONS -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-success text-white">
                    <h4 class="h6 mb-0">
                        <i class="bi bi-gift-fill"></i> Derniers Dons
                    </h4>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <?php foreach($lastDons as $don): ?>
                        <div class="activity-item border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong class="d-block"><?= htmlspecialchars($don['nom_type']) ?></strong>
                                    <small class="text-muted">
                                        <i class="bi bi-box"></i> <?= $don['qte'] ?> unités
                                    </small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-success">
                                        <?= number_format($don['qte'] * $don['prix_unitaire'], 0, ',', ' ') ?> Ar
                                    </span>
                                    <small class="d-block text-muted mt-1">
                                        <i class="bi bi-calendar"></i> 
                                        <?= date('d/m/Y', strtotime($don['date_saisie'])) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- DERNIERES ATTRIBUTIONS -->
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-info text-white">
                    <h4 class="h6 mb-0">
                        <i class="bi bi-arrow-right-circle-fill"></i> Dernières Attributions
                    </h4>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <?php foreach($lastAttrib as $a): ?>
                        <div class="activity-item border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <strong class="d-block">
                                        <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($a['ville']) ?>
                                    </strong>
                                    <small class="text-muted">
                                        <?= $a['qte'] ?> <?= htmlspecialchars($a['nom_type']) ?>
                                    </small>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-info">
                                        <?= number_format($a['qte'] * $a['prix_unitaire'], 0, ',', ' ') ?> Ar
                                    </span>
                                    <small class="d-block text-muted mt-1">
                                        <i class="bi bi-calendar"></i>
                                        <?= date('d/m/Y', strtotime($a['date_mvt'])) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</main>

<style>
/* ================= HERO SECTION ================= */
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), 
                url('<?= $base ?>images/catastrophe.webp') center/cover no-repeat;
    min-height: 400px;
    position: relative;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.hero-overlay {
    padding: 80px 0;
}

.hero-section h1 {
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    animation: fadeInDown 1s ease-out;
}

.hero-section .lead {
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    animation: fadeInUp 1s ease-out 0.2s both;
}

.hero-section .btn {
    animation: fadeInUp 1s ease-out 0.4s both;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.hero-section .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
}

/* ================= ANIMATIONS ================= */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================= STAT CARDS ================= */
.stat-card {
    transition: all 0.3s ease;
    border-radius: 15px;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin: 0 auto 15px;
}

.stat-value {
    font-size: 2rem;
    font-weight: bold;
    margin: 10px 0;
}

.stat-label {
    font-size: 0.9rem;
}

/* ================= CARDS ================= */
.card {
    border-radius: 15px;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

/* ================= TABLE ================= */
.table {
    margin-bottom: 0;
}

.table thead th {
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
}

.table tbody tr {
    transition: all 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .hero-section {
        min-height: 300px;
    }
    
    .hero-overlay {
        padding: 40px 0;
    }
    
    .hero-section h1 {
        font-size: 1.8rem;
    }
    
    .stat-value {
        font-size: 1.5rem;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>