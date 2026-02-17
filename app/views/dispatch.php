<?php
$base = Flight::get('flight.base_url');
use app\models\Dispatch;

$dispatchModel = new Dispatch();
$simulationData = $dispatchModel->simulateDispatchParVille();
$dispatch = $simulationData['dispatch'];
$page_title = "Simulation - BNGRC";

ob_start();
?>

<div class="container mt-4">
    <h1 class="mb-4 text-primary"><i class="bi bi-shuffle"></i> Simulation du Dispatch</h1>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        <strong>Info :</strong> Cette simulation répartit automatiquement les dons disponibles aux villes selon leurs besoins.
    </div>

    <?php if (empty($dispatch)): ?>
        <div class="alert alert-warning">
            ⚠️ Aucun don disponible pour simuler. Vérifiez votre table `don` et l'historique.
        </div>
    <?php else: ?>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white"><h5>Résultats de la Simulation</h5></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ville</th>
                                <th>Type de Besoin</th>
                                <th>Besoin Initial</th>
                                <th>Quantité Attribuée</th>
                                <th>Montant (Ar)</th>
                                <th>Reste Don</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dispatch as $d): ?>
                                <tr>
                                    <td><?= htmlspecialchars($d['ville']) ?></td>
                                    <td><?= htmlspecialchars($d['type']) ?></td>
                                    <td><?= number_format($d['qte_besoin_ville'], 0, ',', ' ') ?></td>
                                    <td><?= number_format($d['attribue'], 0, ',', ' ') ?></td>
                                    <td><?= number_format($d['montant'], 0, ',', ' ') ?> Ar</td>
                                    <td><?= number_format($d['reste_don_type'], 0, ',', ' ') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include 'modele.php';
?>
