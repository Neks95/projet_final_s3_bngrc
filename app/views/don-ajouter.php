<?php
$base_url = Flight::get('flight.base_url');
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ajouter un Don — BNGRC</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS (conservé) -->
    <link rel="stylesheet" href="<?= $base_url ?>css/style.css">
    <style>
        /* très léger : centrer la card */
        body {
            background: #f8f9fa;
            padding: 1.5rem;
        }

        .card {
            max-width: 700px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <main>
        <div class="card shadow-sm">
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

                            <!-- Bouton qui ouvre la modal pour ajouter un nouveau type -->
                            <button type="button" class="btn btn-outline-secondary no-hover"
                                data-bs-toggle="modal" data-bs-target="#addTypeModal">
                                Ajouter un type
                            </button>

                        </div>

                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label for="qte" class="form-label">Quantité <span class="text-danger">*</span></label>
                            <input id="qte" name="qte" type="number" class="form-control" min="1" step="1" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="<?= $base_url ?>dons" class="btn btn-secondary me-2">Annuler</a>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <div class="modal fade" id="addTypeModal" tabindex="-1" aria-labelledby="addTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addTypeForm" method="post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTypeModalLabel"><i class="bi bi-plus-lg"></i> Ajouter un type de don</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div id="addTypeAlert" class="alert d-none" role="alert"></div>

                        <div class="mb-3">
                            <label for="nom_type" class="form-label">Nom du type <span class="text-danger">*</span></label>
                            <input id="nom_type" name="nom_type" type="text" class="form-control" required placeholder="Ex: Riz">
                        </div>

                        <div class="mb-3">
                            <label for="unite_type" class="form-label">Unite</label>
                            <input id="unite_type" name="unite" type="text" class="form-control" placeholder="Ex: kg, L, unités">
                        </div>

                        <div class="mb-3">
                            <label for="categ" class="form-label">Categorie</label>
                            <select name="categ" id="categ">
                                <option value="">-- selection categorie --</option>
                                <?php foreach ($categorie as $c) { ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['nom_categorie'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix unitaire</label>
                            <input id="prix" name="prix" type="number" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annler</button>
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

                                    const bsModal = bootstrap.Modal.getInstance(modalEl) ||
                                        new bootstrap.Modal(modalEl);
                                    bsModal.hide();

                                    addTypeForm.reset();

                                } else {
                                    const msg = data.message || 'Impossible d’ajouter le type.';
                                    showAlert(msg, 'warning');
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

                const formData = new FormData(addTypeForm);
                xhr.send(formData);
            });

            modalEl.addEventListener('show.bs.modal', function() {
                hideAlert();
                submitBtn.disabled = false;
                submitBtn.textContent = 'Ajouter';
            });

        })();
    </script>



</body>

</html>