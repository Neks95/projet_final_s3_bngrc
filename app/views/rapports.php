<?php 
use app\models\Historique;

$base = Flight::get('flight.base_url') ?? '/';
$page_title = "Rapports et Statistiques - BNGRC";

$db = Flight::db();
$historiqueModel = new Historique($db);

$recap = $historiqueModel->getBesoinsRestantParVille();

// Capturer le contenu
ob_start();
?>

<main class="main-content">
<div class="container">

    <div class="mb-4">
        <h1 class="display-5 fw-bold text-primary-custom">Rapports et Statistiques</h1>
        <p class="text-muted">Récapitulatif global de la gestion des dons et des besoins</p>
    </div>

    <div class="mb-4 no-print">
        <button id="btnActualiser" class="btn btn-success">
            <i class="bi bi-arrow-clockwise"></i> Actualiser
        </button>
    </div>

    <div class="row g-4 mb-4" id="recap-content">

        <div class="col-md-6 col-lg-4">
            <div class="stat-card card">
                <div class="card-body text-center">
                    <div class="stat-value" id="montant-total">
                        <?= number_format($recap['montant_total'], 0, ',', ' ') ?> Ar
                    </div>
                    <div class="stat-label">Besoins Totaux</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="stat-card card">
                <div class="card-body text-center">
                    <div class="stat-value" id="montant-satisfait">
                        <?= number_format($recap['montant_satisfait'], 0, ',', ' ') ?> Ar
                    </div>
                    <div class="stat-label">Besoins Satisfaits </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="stat-card card">
                <div class="card-body text-center">
                    <div class="stat-value" id="montant-restant">
                        <?= number_format($recap['montant_restant'], 0, ',', ' ') ?> Ar
                    </div>
                    <div class="stat-label">Besoins Restants </div>
                </div>
            </div>
        </div>

    </div>

</div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('btnActualiser').addEventListener('click', function() {
    const btn = this;
    const icon = btn.querySelector('i');
    
    // Désactiver le bouton et ajouter l'animation
    btn.disabled = true;
    icon.style.animation = 'rotate 1s linear infinite';
    btn.innerHTML = '<i class="bi bi-arrow-clockwise" style="animation: rotate 1s linear infinite;"></i> Actualisation...';
    
    // Requête AJAX
    fetch('<?= $base ?>api/recapitulatif')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Mettre à jour les valeurs
                const totaux = data.data.totaux;
                
                document.getElementById('montant-total').textContent = 
                    Number(totaux.besoins).toLocaleString('fr-FR') + ' Ar';
                
                document.getElementById('montant-satisfait').textContent = 
                    Number(totaux.satisfait).toLocaleString('fr-FR') + ' Ar';
                
                document.getElementById('montant-restant').textContent = 
                    Number(totaux.restant).toLocaleString('fr-FR') + ' Ar';
                
            } else {
                throw new Error(data.error || 'Erreur inconnue');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showToast('Erreur lors de l\'actualisation: ' + error.message, 'error');
        })
        .finally(() => {
            // Réactiver le bouton
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-arrow-clockwise"></i> Actualiser';
        });
});

</script>


<?php
$content = ob_get_clean();
include 'modele.php';
?>