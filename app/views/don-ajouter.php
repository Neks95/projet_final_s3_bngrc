<?php
$base_url = Flight::get('flight.base_url'); 
$page_title = "Ajouter Don - BNGRC";

ob_start();
?>

<main>
    <div class="container py-4">
        <div class="card shadow-sm mx-auto" style="max-width: 700px;">
            <div class="card-body">
                <h4 class="mb-3">Ajouter un Don</h4>

                <form id="addDonForm" method="post" action="<?= $base_url ?>ajouter_dons">
                    <div class="mb-3">
                        <label for="id_type" class="form-label">Type de don <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select id="id_type" name="id_type" class="form-select" required>
                                <option value="">-- Sélectionner --</option>
                                <?php if (!empty($type) && is_array($type)): ?>
                                    <?php foreach ($type as $t):
                                        $tid = isset($t['id']) ? (int)$t['id'] : (isset($t['id_type']) ? (int)$t['id_type'] : 0);
                                        $tname = isset($t['nom_type']) ? $t['nom_type'] : (isset($t['type_name']) ? $t['type_name'] : '');
                                        if ($tid === 0) continue;
                                    ?>
                                        <option value="<?= $tid ?>"><?= htmlspecialchars($tname) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <button type="button" class="btn btn-outline-secondary no-hover"
                                data-bs-toggle="modal" data-bs-target="#addTypeModal">
                                Ajouter un type
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="qte" class="form-label">Quantité <span class="text-danger">*</span></label>
                        <input id="qte" name="qte" type="number" class="form-control" min="1" step="1" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">


                        <a href="<?= $base_url ?>gestion_don" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Annuler
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Enregistrer
                        </button>
                    </div>

                </form>

                         <a href="<?= $base_url ?>gestion_don" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left"></i> Revenir
                        </a>

                        <a href="<?= $base_url ?>dispatch" class="btn btn-outline-primary">
                            <i class="bi bi-graph-up"></i> Simulation
                        </a>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addTypeForm" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTypeModalLabel"><i class="bi bi-plus-lg"></i> Ajouter un type de don</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <div id="addTypeAlert" class="alert d-none" role="alert"></div>

                    <div class="mb-3">
                        <label for="nom_type_modal" class="form-label">Nom du type <span class="text-danger">*</span></label>
                        <input id="nom_type_modal" name="nom_type" type="text" class="form-control" required placeholder="Ex: Riz">
                    </div>

                    <div class="mb-3">
                        <label for="unite_modal" class="form-label">Unité</label>
                        <input id="unite_modal" name="unite" type="text" class="form-control" placeholder="Ex: kg, L, unités">
                    </div>

                    <div class="mb-3">
                        <label for="categ_modal" class="form-label">Catégorie</label>
                        <select name="categ" id="categ_modal" class="form-select">
                            <option value="">-- selection categorie --</option>
                            <?php foreach ($categorie as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['nom_categorie'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="prix" class="form-label">Prix unitaire</label>
                        <input id="prix" name="prix" type="number" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button id="submitAddTypeBtn" type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>

 
        </div>
    </div>
 

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
(function() {
    const addTypeUrl = '<?= $base_url ?>ajout_type';
    const addTypeForm = document.getElementById('addTypeForm');
    const addTypeAlert = document.getElementById('addTypeAlert');
    const submitBtn = document.getElementById('submitAddTypeBtn');
    const modalEl = document.getElementById('addTypeModal');
    const idTypeSelect = document.getElementById('id_type');

    function showAlert(message, type = 'danger') {
        addTypeAlert.className = 'alert alert-' + type;
        addTypeAlert.textContent = message;
        addTypeAlert.classList.remove('d-none');
    }

    function hideAlert() {
        addTypeAlert.classList.add('d-none');
    }

    addTypeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        hideAlert();
        submitBtn.disabled = true;
        submitBtn.textContent = 'Ajout en cours...';

        const xhr = new XMLHttpRequest();
        xhr.open('POST', addTypeUrl, true);
        xhr.setRequestHeader('Accept', 'application/json');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Ajouter';
                if (xhr.status === 200) {
                    try {
                        const data = JSON.parse(xhr.responseText);
                        if (data && data.success) {
                            const opt = document.createElement('option');
                            opt.value = data.id;
                            opt.textContent = data.nom_type;
                            idTypeSelect.appendChild(opt);
                            idTypeSelect.value = data.id;

                            const bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                            bsModal.hide();
                            addTypeForm.reset();
                        } else {
                            showAlert(data.message || 'Impossible d’ajouter le type.', 'warning');
                        }
                    } catch (err) {
                        showAlert('Erreur JSON invalide.', 'danger');
                    }
                } else {
                    showAlert('Erreur serveur : ' + xhr.status, 'danger');
                }
            }
        };

        xhr.onerror = function() {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Ajouter';
            showAlert('Erreur réseau.', 'danger');
        };

        xhr.send(new FormData(addTypeForm));
    });

    modalEl.addEventListener('show.bs.modal', function() {
        hideAlert();
        submitBtn.disabled = false;
        submitBtn.textContent = 'Ajouter';
    });
})();
</script>

<?php
$content = ob_get_clean();
include 'modele.php';
?>
