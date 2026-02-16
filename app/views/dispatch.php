<?php 
$base = Flight::get('flight.base_url'); 

use app\models\Dispatch;


$dispatchModel = new Dispatch();
$dispatch = $dispatchModel->simulateDispatchParVille();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dispatch - BNGRC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>dispatch">Simulation</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base ?>rapports">Rapports</a></li>
                    </ul>
                    <div class="ms-3 text-white small" id="current-datetime"></div>
                </div>
            </div>
        </nav>
    </header>

<div class="container mt-4">
    <h1 class="mb-4 text-primary">Simulation du Dispatch</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Ville</th>
                    <th>Type de Besoin</th>
                    <th>Besoin de cette ville</th>
                    <th>Quantité attribuée</th>
                    <th>Montant (Ar)</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($dispatch as $i => $d): ?>
                    <tr>
                        <td><?= htmlspecialchars($d['ville']) ?></td>
                        <td><?= htmlspecialchars($d['type']) ?></td>
                        <td><?= $d['qte_besoin_ville'] ?></td>
                        <td><?= $d['attribue'] ?></td>
                        <td><?= number_format($d['montant'], 0, ',', ' ') ?> Ar</td>
                        <td>
                            <button class="btn btn-sm btn-info" data-bs-toggle="collapse" data-bs-target="#detail-<?= $i ?>">
                                Détails
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="detail-<?= $i ?>">
                        <td colspan="6">
                            <?php
                            // Total disponible dans tous les dons pour ce type
                            $totalDonType = array_sum(array_column($donsRestants[$d['id_type']] ?? [], 'qte')) + $d['attribue'];

                            // Besoin total de cette ville pour ce type
                            $besoinVilleType = $d['qte_besoin_ville'];

                            // Reste après attribution
                            $resteDon = $totalDonType - $d['attribue'];
                            ?>
                            <strong>Total Don pour ce type :</strong> <?= $totalDonType ?><br>
                            <strong>Besoin de cette ville :</strong> <?= $besoinVilleType ?><br>
                            <strong>Reste du don après attribution :</strong> <?= $resteDon ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

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
