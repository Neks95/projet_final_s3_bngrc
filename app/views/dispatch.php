<?php 
$base = Flight::get('flight.base_url'); 
use app\models\dispatch;

// Charger les données mais ne pas afficher le tableau tout de suite
$dispatchModel = new Dispatch();
$dispatch = $dispatchModel->simulateDispatchParVille();

$page_title = "Simulation - BNGRC";

ob_start();
?>

<div class="container mt-4">
    <h1 class="mb-4 text-primary">Simulation du Dispatch</h1>

    <!-- Bouton Simuler -->
    <div class="mb-3">
        <button id="btnSimuler" class="btn btn-success">
            <i class="bi bi-arrow-repeat"></i> Simuler
        </button>
    </div>

    <!-- Tableau caché au départ -->
    <div id="tableDispatch" style="display: none;">
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
                                $totalDonType = array_sum(array_column($donsRestants[$d['id_type']] ?? [], 'qte')) + $d['attribue'];
                                $besoinVilleType = $d['qte_besoin_ville'];
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

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Afficher le tableau lorsque l'on clique sur "Simuler"
    document.getElementById('btnSimuler').addEventListener('click', function() {
        document.getElementById('tableDispatch').style.display = 'block';
        this.disabled = true; // optionnel : désactive le bouton après clic
    });
</script>

<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>