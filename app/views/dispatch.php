<?php
$base_url = Flight::get('flight.base_url');

$page_title = "Gestion des dispatch - BNGRC";

ob_start();
?>
<div class="container mt-4">
    <h1 class="mb-4 text-primary"><i class="bi bi-shuffle"></i> Simulation du Dispatch</h1>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        <strong>Info :</strong> Simuler avant de valider !
    </div>

    <div class="mb-3 d-flex flex-wrap align-items-center gap-2">
        <label for="modeSimulation" class="form-label mb-0">Mode de Simulation :</label>
        <select id="modeSimulation" class="form-select w-auto d-inline-block">
            <option value="date">Priorite par Date</option>
            <option value="plusPetit">Priorite par le plus Petit</option>
            <option value="proportion">Priorite par Proportionnalite</option>
        </select>

        <button id="btnSimuler" class="btn btn-success">
            <i class="bi bi-arrow-repeat"></i> Simuler
        </button>

        <a href="<?= $base_url ?>ajout_don" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un Don
        </a>

        <a href="<?= $base_url ?>ajout_besoin" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un Besoin
        </a>

        <button id="btnRevenir" class="btn btn-danger">
            Revenir a l'etat initial
        </button>
    </div>

    <div id="loadingSpinner" class="text-center my-4" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Chargement...</span>
        </div>
        <p class="mt-2">Simulation en cours...</p>
    </div>

    <div id="tableDispatchContainer" style="display: none;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Résultats de la Simulation</h5>
                <span id="modeLabel" class="badge bg-light text-primary"></span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="tableDispatch" class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Ville</th>
                                <th>Type de Besoin</th>
                                <th>Besoin Initial</th>
                                <th>Quantite Attribuee</th>
                                <th>Montant (Ar)</th>
                                <th>Reste Don</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3 text-end">
            <button id="btnValider" class="btn btn-primary" style="display:none;">
                <i class="bi bi-check-circle"></i> Valider le Dispatch
            </button>
        </div>
    </div>
</div>

<!-- Toast Container (utilisé pour remplacer les alert()) -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1200;">
    <div id="liveToast" class="toast align-items-center border-0" role="alert" aria-live="polite" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage">Message ici</div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function showToast(message, type = 'info', delay = 3000) {
            if (window.bootstrap && bootstrap.Toast) {
                const toastEl = document.getElementById('liveToast');
                const toastMessage = document.getElementById('toastMessage');

                const bgClasses = ['bg-success','bg-danger','bg-warning','bg-info','bg-primary','bg-secondary','bg-light','bg-dark'];
                const textWhite = 'text-white';
                const textDark = 'text-dark';

                toastEl.classList.remove(...bgClasses);
                toastEl.classList.remove(textWhite, textDark);

                const map = {
                    'success': 'bg-success',
                    'error': 'bg-danger',
                    'danger': 'bg-danger',
                    'warning': 'bg-warning',
                    'info': 'bg-info',
                    'primary': 'bg-primary',
                    'secondary': 'bg-secondary'
                };
                const chosenBg = map[type] || map['info'];
                toastEl.classList.add(chosenBg);

                if (chosenBg === 'bg-warning' || chosenBg === 'bg-light') {
                    toastEl.classList.add(textDark);
                } else {
                    toastEl.classList.add(textWhite);
                }

                toastMessage.textContent = message;

                const bsToast = bootstrap.Toast.getOrCreateInstance(toastEl, { delay: delay });

                bsToast.show();
            } else {
                alert(message);
            }
        }

        const btnSimuler = document.getElementById('btnSimuler');
        const btnValider = document.getElementById('btnValider');
        const tableContainer = document.getElementById('tableDispatchContainer');
        const tableBody = document.querySelector('#tableDispatch tbody');
        const retour = document.getElementById('btnRevenir');
        const modeSelect = document.getElementById('modeSimulation');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const modeLabel = document.getElementById('modeLabel');

        const modeLabels = {
            'date': 'Priorité par Date',
            'plusPetit': 'Priorité par le Plus Petit',
            'proportion': 'Priorité par Proportionnalité'
        };

        function renderTable(dispatchData) {
            tableBody.innerHTML = '';

            if (dispatchData.length === 0) {
                const row = document.createElement('tr');
                row.innerHTML = '<td colspan="6" class="text-center text-muted">Aucune donnée à afficher. Vérifiez les besoins et les dons.</td>';
                tableBody.appendChild(row);
                btnValider.style.display = 'none';
                return;
            }

            dispatchData.forEach(d => {
                const row = document.createElement('tr');

                if (d.attribue === 0) {
                    row.classList.add('table-warning');
                }

                row.innerHTML = `
                    <td>${d.ville}</td>
                    <td>${d.type}</td>
                    <td>${Number(d.qte_besoin_ville).toLocaleString('fr-FR')}</td>
                    <td>${Number(d.attribue).toLocaleString('fr-FR')}</td>
                    <td>${Number(d.montant).toLocaleString('fr-FR', {minimumFractionDigits: 2})} Ar</td>
                    <td>${Number(d.reste_don_type).toLocaleString('fr-FR')}</td>
                `;
                tableBody.appendChild(row);
            });

            btnValider.style.display = 'inline-block';
        }

        btnSimuler.addEventListener('click', function() {
            const mode = modeSelect.value;

            loadingSpinner.style.display = 'block';
            tableContainer.style.display = 'none';
            btnSimuler.disabled = true;

            fetch(`<?= $base_url ?>dispatch/simuler?mode=${encodeURIComponent(mode)}`)
                .then(r => {
                    if (!r.ok) throw new Error('Erreur serveur : ' + r.status);
                    return r.json();
                })
                .then(data => {
                    loadingSpinner.style.display = 'none';

                    if (data.success) {
                        tableContainer.style.display = 'block';
                        modeLabel.textContent = modeLabels[data.mode] || data.mode;
                        renderTable(data.dispatch);
                    } else {
                        showToast('Erreur : ' + (data.message || 'Simulation échouée.'), 'error');
                        btnSimuler.disabled = false;
                    }
                })
                .catch(err => {
                    loadingSpinner.style.display = 'none';
                    showToast('Erreur lors de la simulation : ' + err.message, 'error');
                    btnSimuler.disabled = false;
                });
        });

        
        btnValider.addEventListener('click', function() {
            if (!confirm("Confirmer la validation du dispatch ?")) return;

            const mode = modeSelect.value;
            btnValider.disabled = true;
            btnValider.innerHTML = '<i class="bi bi-hourglass-split"></i> Validation en cours...';

            fetch("<?= $base_url ?>dispatch/valider", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `mode=${encodeURIComponent(mode)}`
                })
                .then(r => {
                    if (!r.ok) throw new Error('Erreur serveur : ' + r.status);
                    return r.json();
                })
                .then(data => {
                    showToast(data.message || 'Dispatch validé !', 'success');
                    setTimeout(() => location.reload(), 1000);
                })
                .catch(err => {
                    showToast('Erreur lors de la validation : ' + err.message, 'error');
                    btnValider.disabled = false;
                    btnValider.innerHTML = '<i class="bi bi-check-circle"></i> Valider le Dispatch';
                });
        });

      
        retour.addEventListener('click', function() {
            if (!confirm("Confirmer le retour à l'état initial ?")) return;

            fetch('<?= $base_url ?>restore_initial', {
                    method: 'POST'
                })
                .then(r => r.json())
                .then(data => {
                    showToast(data.message || 'Restauration effectuée', 'success');
                    setTimeout(() => location.reload(), 700);
                })
                .catch(err => showToast("Erreur lors de la restauration.", 'error'));
        });
    });
</script>
<?php
$content = ob_get_clean();
include 'modele.php';
?>