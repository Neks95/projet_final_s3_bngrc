<?php
 $base = Flight::get('flight.base_url'); 
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Ville - BNGRC</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $base ?>css/style.css">
</head>

<body>

    <!-- Header (inchangé) -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= $base ?>/">
                    <div class="logo">BNGRC</div>
                    <span>Gestion des Dons</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base ?>/">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= $base ?>/villes">Villes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base ?>/besoins">Besoins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base ?>/dons">Dons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base ?>/attributions">Attributions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base ?>/simulation">Simulation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base ?>/rapports">Rapports</a>
                        </li>
                    </ul>
                    <div class="ms-3 text-white small" id="current-datetime"></div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">

            <!-- Page Title (inchangé) -->
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary-custom">Ajouter une Ville</h1>
                <p class="text-muted">Enregistrer une nouvelle ville affectée</p>
            </div>

            <!-- Formulaire – POST vers la route -->
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

    <!-- Footer (année dynamique) -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>BNGRC</h5>
                    <p>Bureau National de Gestion des Risques et des Catastrophes</p>
                    <p>&copy; 2026 BNGRC. Tous droits réservés.</p>
                </div>
                <div class="col-md-3">
                    <h5>Liens Utiles</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Aide</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <p>Email: contact@bngrc.gov.mg<br>
                        Tél: +261 20 XX XXX XX</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts (inchangés) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base ?>/js/app.js"></script>

</body>

</html>