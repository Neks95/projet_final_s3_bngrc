<?php
$base_url = Flight::get('flight.base_url'); 

$page_title = "Ajout des Besoins - BNGRC";

ob_start();
?>

    <!-- Main Content -->
    <main class="main-content ms-5">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= $base_url ?>gestion_besoin">Besoins</a></li>
                    <li class="breadcrumb-item active">Ajouter</li>
                </ol>
            </nav>

            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Ajouter un Besoin</h1>
                <p class="text-muted">Enregistrer un nouveau besoin identifié</p>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-container">
                        <form id="addBesoinForm" action="<?= $base_url ?>ajouter_besoin" method="post">
                            <div class="mb-3">
                                <label for="ville" class="form-label">
                                    Ville
                                </label>
                                <select class="form-select" id="ville" name="ville" required>
                                    <option value="">Selectionner une ville</option>
                                    <?php foreach ($ville as $v) { ?>
                                        <option value="<?= $v['id'] ?>"><?= $v['nom'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez selectionner une ville.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">
                                    Type
                                </label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Selectionner un type</option>
                                    <?php foreach ($type as $t) { ?>
                                        <option value="<?= $t['id'] ?>"><?= $t['nom_type'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez selectionner une type.
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantite" class="form-label">
                                        Quantité
                                    </label>
                                    <input type="number" class="form-control" id="quantite" name="quantite" required min="1" step="1" placeholder="Ex: 1000">
                                    <div class="invalid-feedback">
                                        Veuillez saisir une quantité valide.
                                    </div>
                                </div>

                                <!-- <div class="col-md-6 mb-3">
                                    <label for="prix_unitaire" class="form-label">
                                        Prix Unitaire (Ar)
                                    </label>
                                    <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" required min="0" step="0.01" placeholder="Ex: 2500.00">
                                    <div class="invalid-feedback">
                                        Veuillez saisir un prix unitaire valide.
                                    </div>
                                </div> -->
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Enregistrer
                                </button>
                                <a href="besoins.html" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= $base_url ?>js/app.js"></script>
    
<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>