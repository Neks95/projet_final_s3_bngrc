<?php 

$base_url = Flight::get('flight.base_url'); 
// var_dump($type);
// var_dump($ville);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Besoin - BNGRC</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $base_url ?>css/style.css">
</head>

<body>
    <!-- Header -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <div class="logo">BNGRC</div>
                    <span>Gestion des Dons</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="villes.html">Villes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="besoins.html">Besoins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dons.html">Dons</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="attributions.html">Attributions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="simulation.html">Simulation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="rapports.html">Rapports</a>
                        </li>
                    </ul>
                    <div class="ms-3 text-white small" id="current-datetime"></div>
                </div>
            </div>
        </nav>
    </header>

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= $base_url ?>js/app.js"></script>

    >

</body>

</html>