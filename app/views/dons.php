<?php
$base_url = Flight::get('flight.base_url');

$page_title = "Gestion des Besoins - BNGRC";

ob_start();
?>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= $base_url ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Dons</li>
            </ol>
        </nav>

        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="display-5 fw-bold text-primary-custom">Gestion des Dons</h1>
                <p class="text-muted">Liste des dons reçus et leur statut</p>
            </div>
            <a href="<?= $base_url ?>ajout_don" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Ajouter un Don
            </a>
        </div>
        <!-- Tableau des dons -->
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h4 mb-0">Liste des Dons</h3>
            </div>

            <div class="table-responsive card p-3">
                <table class="table table-hover table-sm align-middle" id="donsTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th class="text-end">Quantité</th>
                            <th>Unité</th>
                            <th class="text-end">Prix unitaire</th>
                            <th class="text-end">Montant total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($don) && is_array($don)): ?>
                            <?php foreach ($don as $d):
                                $id = isset($d['id']) ? (int)$d['id'] : 0;
                                $qte = isset($d['qte']) ? (float)$d['qte'] : 0;
                                $type = isset($d['nom_type']) ? htmlspecialchars($d['nom_type']) : '';
                                $unite = isset($d['unite']) ? htmlspecialchars($d['unite']) : '';
                                $prix = isset($d['prix_unitaire']) ? (float)$d['prix_unitaire'] : 0;
                                $date = !empty($d['date_saisie']) ? date('d/m/Y', strtotime($d['date_saisie'])) : '';
                                $montant = $qte * $prix;
                            ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $type ?></td>
                                    <td class="text-end"><?= number_format($qte, 0, ',', ' ') ?></td>
                                    <td><?= $unite ?></td>
                                    <td class="text-end"><?= number_format($prix, 0, ',', ' ') ?> Ar</td>
                                    <td class="text-end"><?= number_format($montant, 0, ',', ' ') ?> Ar</td>
                                    <td><?= $date ?></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-4">Aucun don enregistré.</td>
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