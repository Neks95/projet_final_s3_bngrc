<?php
// Variables communes / configuration
$base = Flight::get('flight.base_url') ?? '/';

// Titre par défaut (peut être surchargé par la page)
$page_title = $page_title ?? 'BNGRC - Gestion des Dons';

// Classe active pour le menu (optionnel)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $base ?>css/style.css">
</head>
<body>

<!-- Header / Navigation -->
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
                        <a class="nav-link <?= ($current_page === 'index.php' || $current_page === '') ? 'active' : '' ?>" 
                           href="<?= $base ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page === 'villes.php' ? 'active' : '' ?>" 
                           href="<?= $base ?>villes">Villes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>gestion_besoin">Besoins</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>gestion_don">Dons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>attributions">Attributions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>simulation">Simulation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>rapports">Rapports</a>
                    </li>
                </ul>
                <div class="ms-3 text-white small" id="current-datetime"></div>
            </div>
        </div>
    </nav>
</header>

<!-- Contenu principal (ici vient le contenu spécifique de chaque page) -->
<main class="main-content">
    <?php
    // C’est ici que la page appelle include 'contenu.php' ou affiche directement son contenu
    if (isset($content_file) && file_exists($content_file)) {
        include $content_file;
    } elseif (isset($content)) {
        echo $content;
    } else {
        echo '<div class="container"><p class="text-center text-muted py-5">Aucun contenu défini</p></div>';
    }
    ?>
</main>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>BNGRC</h5>
                <p>Bureau National de Gestion des Risques et des Catastrophes</p>
                <p>&copy; <?= date('Y') ?> BNGRC. Tous droits réservés.</p>
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
                <p>Email: contact@bngrc.gov.mg<br>Tél: +261 20 XX XXX XX</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $base ?>js/app.js"></script>

</body>
</html>