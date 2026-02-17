<?php
$base = Flight::get('flight.base_url'); 

$page_title = "Ajout des Villes - BNGRC";

ob_start();
?>
    <!-- Main Content -->
    <main class="main-content">
        <div class="container">

            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Ajouter une Ville</h1>
                <p class="text-muted">Enregistrer une nouvelle ville affectée</p>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-container">
                        <form id="addVilleForm" method="POST" action="<?= $base ?>villes/ajouter">
                            <div class="mb-3">
                                <label for="nom_ville" class="form-label">
                                    Nom de la Ville <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="nom_ville" name="nom" required placeholder="Ex: Toamasina" maxlength="200">
                                <div class="invalid-feedback">
                                    Veuillez saisir le nom de la ville.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="region" class="form-label">
                                    Région <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="region" name="region" required>
                                    <option value="">Sélectionner une région</option>
                                    <option value="Analamanga">Analamanga</option>
                                    <option value="Atsinanana">Atsinanana</option>
                                    <option value="Vatovavy Fitovinany">Vatovavy Fitovinany</option>
                                    <option value="Atsimo Atsinanana">Atsimo Atsinanana</option>
                                    <option value="Haute Matsiatra">Haute Matsiatra</option>
                                    <option value="Amoron'i Mania">Amoron'i Mania</option>
                                    <option value="Vakinankaratra">Vakinankaratra</option>
                                    <option value="Itasy">Itasy</option>
                                    <option value="Bongolava">Bongolava</option>
                                    <option value="Sofia">Sofia</option>
                                    <option value="Boeny">Boeny</option>
                                    <option value="Betsiboka">Betsiboka</option>
                                    <option value="Melaky">Melaky</option>
                                    <option value="Alaotra Mangoro">Alaotra Mangoro</option>
                                    <option value="Analanjirofo">Analanjirofo</option>
                                    <option value="Diana">Diana</option>
                                    <option value="Sava">Sava</option>
                                    <option value="Ihorombe">Ihorombe</option>
                                    <option value="Atsimo Andrefana">Atsimo Andrefana</option>
                                    <option value="Menabe">Menabe</option>
                                    <option value="Androy">Androy</option>
                                    <option value="Anosy">Anosy</option>
                                </select>
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une région.
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i>
                                Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Enregistrer
                                </button>
                                <a href="<?= $base ?>/villes" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Annuler
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base ?>/js/app.js"></script>

<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>