<?php
$base_url = Flight::get('flight.base_url'); 

use app\models\Dispatch;

$dispatchModel = new Dispatch();
$simulationData = $dispatchModel->simulateDispatchParVille();
$dispatch = $simulationData['dispatch'] ?? [];
$page_title = "Simulation - BNGRC";

ob_start();
?>

<div class="container mt-4">
    <h1 class="mb-4 text-primary"><i class="bi bi-shuffle"></i> Simulation du Dispatch</h1>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        <strong>Info :</strong> Cette simulation répartit automatiquement les dons disponibles aux villes selon leurs besoins.
    </div>

    <div class="mb-3">
        <button id="btnSimuler" class="btn btn-success">
            <i class="bi bi-arrow-repeat"></i> Simuler
        </button>
        <button id="btnValider" class="btn btn-primary ms-2" style="display: none;">
            <i class="bi bi-check-circle"></i> Valider le Dispatch
        </button>
            <a href="<?= $base_url ?>ajout_don" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ajouter un Don
            </a>
            <a href="<?= $base_url ?>ajout_besoin" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ajouter un Besoin
            </a>

    </div>

    <div id="tableDispatch" style="display: none;">
        <?php if (empty($dispatch)): ?>
            <div class="alert alert-warning">
                 Aucun don disponible pour simuler. Vérifiez votre table `don` et l'historique.
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
</div>

<?php
$content = ob_get_clean();
include 'modele.php';
?>

<script>
    // Afficher le tableau et le bouton Valider lorsque l'on clique sur "Simuler"
    document.addEventListener('DOMContentLoaded', function() {
        var btnSimuler = document.getElementById('btnSimuler');
        var btnValider = document.getElementById('btnValider');
        var tableDispatch = document.getElementById('tableDispatch');

        if (btnSimuler) {
            btnSimuler.addEventListener('click', function() {
                if (tableDispatch) tableDispatch.style.display = 'block';
                if (btnValider) btnValider.style.display = 'inline-block';
                btnSimuler.disabled = true;
            });
        }

        if (btnValider) {
            btnValider.addEventListener('click', function() {
                if (!confirm("Confirmer la validation du dispatch ?")) return;
                btnValider.disabled = true;
                btnValider.innerText = 'Validation en cours...';

                fetch("<?= $base_url ?>dispatch/valider", { method: 'POST' })
                    .then(function(r){ return r.json(); })
                    .then(function(data){
                        alert(data.message || 'Opération terminée');
                        window.location.reload();
                    })
                    .catch(function(err){
                        alert('Erreur lors de la validation: ' + err);
                        btnValider.disabled = false;
                        btnValider.innerText = 'Valider le Dispatch';
                    });
            });
        }
    });
</script>
