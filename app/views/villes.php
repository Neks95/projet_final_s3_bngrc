<?php 
use app\controllers\VilleController;

// Récupérer les données
$villes = (new VilleController())->getAllVille();

// Configuration de la page
$page_title = "Gestion des Villes - BNGRC";
$base = Flight::get('flight.base_url') ?? '/';

// Définir le contenu directement avec ob_start/ob_get_clean
ob_start();
?>

<!-- Contenu de la page villes -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold text-primary">Gestion des Villes</h1>
            <p class="text-muted">Liste des villes affectées par les catastrophes</p>
        </div>
        <a href="<?= $base ?>villes/ajouter" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une Ville
        </a>
    </div>

    <!-- Filtres et Recherche -->
    <div class="filters-container">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="searchVille" class="form-label">Rechercher</label>
                <input type="text" class="form-control" id="searchVille" placeholder="Rechercher par nom de ville...">
            </div>
            <div class="col-md-3">
                <label for="filterRegion" class="form-label">Filtrer par Région</label>
                <select class="form-select" id="filterRegion">
                    <option value="">Toutes les régions</option>
                    <option value="atsinanana">Atsinanana</option>
                    <option value="vatovavy">Vatovavy Fitovinany</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="sortBy" class="form-label">Trier par</label>
                <select class="form-select" id="sortBy">
                    <option value="nom">Nom</option>
                    <option value="region">Région</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tableau des villes -->
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="h4 mb-0">Liste des Villes</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="villesTable">
                <thead>
                    <tr>
                        <th class="sortable">Nom</th>
                        <th class="sortable">Région</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($villes)): ?>
                        <?php foreach($villes as $v): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($v['nom']) ?></strong></td>
                            <td><?= htmlspecialchars($v['region']) ?></td>
                           
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">Aucune ville trouvée</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center"></ul>
        </nav>
    </div>
</div>

<!-- Scripts spécifiques -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        makeSortable('villesTable');
        filterTable('searchVille', 'villesTable');
        filterTableBySelect('filterRegion', 'villesTable', 1);
        initPagination('villesTable', 10);
    });
</script>

<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>