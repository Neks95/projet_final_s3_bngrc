<?php
$base = Flight::get('flight.base_url');
use app\models\Dispatch;

$dispatchModel = new Dispatch();
$result = $dispatchModel->simulateDispatchParVille();
$dispatch = $result['dispatch'] ?? [];

$page_title = "Simulation - BNGRC";
$dispatch = $dispatchModel->simulateDispatchParVille();

$page_title = "Simulation - BNGRC";

ob_start();
?>

<div class="container mt-4">
    <h1 class="mb-4 text-primary">Simulation du Dispatch</h1>

    <div class="mb-3">
        <button id="btnSimuler" class="btn btn-success">
            <i class="bi bi-arrow-repeat"></i> Simuler
        </button>
    </div>

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
                        <th>Reste du don (ce type)</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dispatch)): ?>
                        <?php foreach ($dispatch as $i => $d): ?>
                            <tr>
                                <td><?= htmlspecialchars($d['ville']) ?></td>
                                <td><?= htmlspecialchars($d['type']) ?></td>
                                <td><?= $d['qte_besoin_ville'] ?></td>
                                <td><?= $d['attribue'] ?></td>
                                <td><?= number_format($d['montant'], 0, ',', ' ') ?> Ar</td>
                                <td>
                                    <span class="badge bg-<?= $d['reste_don_type'] > 0 ? 'success' : 'danger' ?>">
                                        <?= $d['reste_don_type'] ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-detail" data-index="<?= $i ?>">
                                        Détails
                                    </button>
                                </td>
                            </tr>
                            <tr id="detail-<?= $i ?>" style="display: none;">
                                <td colspan="7">
                                    <div class="p-2 bg-light rounded">
                                        <strong>Total initial des dons (<?= htmlspecialchars($d['type']) ?>) :</strong>
                                        <?= $d['total_don_init_type'] ?><br>

                                        <strong>Attribué à <?= htmlspecialchars($d['ville']) ?> :</strong>
                                        <?= $d['attribue'] ?><br>

                                        <strong>Reste de ce don (Don #<?= $d['don_id'] ?>) :</strong>
                                        <?= $d['reste_don_ce_don'] ?><br>

                                        <strong>Reste global pour ce type après cette attribution :</strong>
                                        <span class="fw-bold text-<?= $d['reste_don_type'] > 0 ? 'success' : 'danger' ?>">
                                            <?= $d['reste_don_type'] ?>
                                        </span><br>

                                        <strong>Besoin restant pour cette ville :</strong>
                                        <?= $d['reste_besoin_ville'] ?>
                                        <?php if ($d['reste_besoin_ville'] > 0): ?>
                                            <span class="text-warning">(besoin non couvert)</span>
                                        <?php else: ?>
                                            <span class="text-success">(besoin couvert)</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Aucune donnée de simulation disponible.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Afficher le tableau
    document.getElementById('btnSimuler').addEventListener('click', function() {
        document.getElementById('tableDispatch').style.display = 'block';
        this.disabled = true;
    });

    // Toggle détails sur chaque ligne
    document.querySelectorAll('.btn-detail').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var index = this.getAttribute('data-index');
            var detailRow = document.getElementById('detail-' + index);

            if (detailRow.style.display === 'none') {
                detailRow.style.display = 'table-row';
                this.textContent = 'Masquer';
                this.classList.remove('btn-info');
                this.classList.add('btn-secondary');
            } else {
                detailRow.style.display = 'none';
                this.textContent = 'Détails';
                this.classList.remove('btn-secondary');
                this.classList.add('btn-info');
            }
        });
    });
</script>

<?php
$content = ob_get_clean();
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>