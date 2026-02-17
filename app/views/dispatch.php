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
            <option value="date">Priorité par Date</option>
            <option value="plusPetit">Priorité par le Plus Petit</option>
            <option value="proportion">Priorité par Proportionnalité</option>
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




    <div id="tableDispatchContainer" style="display: none;">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5>Résultats de la Simulation</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="tableDispatch" class="table table-hover table-striped mb-0">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btnSimuler = document.getElementById('btnSimuler');
        const btnValider = document.getElementById('btnValider');
        const tableContainer = document.getElementById('tableDispatchContainer');
        const tableBody = document.querySelector('#tableDispatch tbody');
        const retour = document.getElementById('btnRevenir');
        const modeSelect = document.getElementById('modeSimulation');

        function simulateDispatch(mode) {
            const villes = ['Antananarivo', 'Fianarantsoa', 'Toamasina'];
            const types = ['Eau', 'Nourriture', 'Médicaments'];
            let result = [];

            villes.forEach(ville => {
                types.forEach(type => {
                    const besoin = Math.floor(Math.random() * 1000) + 100;
                    const attribue = Math.floor(besoin * Math.random());
                    result.push({
                        ville: ville,
                        type: type,
                        qte_besoin_ville: besoin,
                        attribue: attribue,
                        montant: attribue * 1000,
                        reste_don_type: besoin - attribue
                    });
                });
            });

            if (mode === 'plusPetit') {
                result.sort((a, b) => a.qte_besoin_ville - b.qte_besoin_ville);
            } else if (mode === 'proportion') {
                result.sort((a, b) => (a.attribue / a.qte_besoin_ville) - (b.attribue / b.qte_besoin_ville));
            }

            return result;
        }

        function renderTable(dispatchData) {
            tableBody.innerHTML = '';
            dispatchData.forEach(d => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${d.ville}</td>
                <td>${d.type}</td>
                <td>${d.qte_besoin_ville.toLocaleString('fr-FR')}</td>
                <td>${d.attribue.toLocaleString('fr-FR')}</td>
                <td>${d.montant.toLocaleString('fr-FR')} Ar</td>
                <td>${d.reste_don_type.toLocaleString('fr-FR')}</td>
            `;
                tableBody.appendChild(row);
            });

            btnValider.style.display = 'inline-block';
        }

        btnSimuler.addEventListener('click', function() {
            const mode = modeSelect.value;
            const dispatchData = simulateDispatch(mode);

            tableContainer.style.display = 'block';
            renderTable(dispatchData);
            btnSimuler.disabled = true;
        });

        btnValider.addEventListener('click', function() {
            if (!confirm("Confirmer la validation du dispatch ?")) return;
            btnValider.disabled = true;
            btnValider.innerText = 'Validation en cours...';

            fetch("<?= $base_url ?>dispatch/valider", {
                    method: 'POST'
                })
                .then(r => r.json())
                .then(data => {
                    alert(data.message || 'Dispatch validé !');
                    location.reload();
                })
                .catch(err => {
                    alert('Erreur lors de la validation: ' + err);
                    btnValider.disabled = false;
                    btnValider.innerText = 'Valider le Dispatch';
                });
        });

        retour.addEventListener('click', function() {
            if (!confirm("Confirmer le retour à l'état initial ?")) return;

            fetch('<?= $base_url ?>restore_initial', {
                    method: 'POST'
                })
                .then(r => r.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                })
                .catch(err => alert("Erreur lors de la restauration."));
        });
    });
</script>
<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>