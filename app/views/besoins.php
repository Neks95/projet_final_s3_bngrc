<?php
$base_url = Flight::get('flight.base_url'); 

$page_title = "Gestion des Besoins - BNGRC";

ob_start();
?>

    <main class="main-content">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $base_url ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Besoins</li>
                </ol>
            </nav>

            <!-- Page Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-5 fw-bold text-primary-custom">Gestion des Besoins</h1>
                    <p class="text-muted">Liste des besoins identifiés par ville</p>
                </div>
                <a href="<?= $base_url ?>ajout_besoin" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter un Besoin
                </a>
            </div>

            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h4 mb-0">Liste des Besoins (<?= isset($besoin) ? count($besoin) : '0' ?> résultats)</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="besoinsTable">
                        <thead>
                            <tr>
                                <th>Ville</th>
                                <th>Région</th>
                                <th>Catégorie</th>
                                <th>Type</th>
                                <th>Unité</th>
                                <th class="text-end">Quantité</th>
                                <th class="text-end">Prix Unitaire</th>
                                <th class="text-end">Montant Total</th>
                                <th class="text-center">Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($besoin) && is_array($besoin)): ?>
                                <?php foreach ($besoin as $b): 
                                    $id    = isset($b['id']) ? (int)$b['id'] : 0;
                                    $ville = isset($b['ville']) ? htmlspecialchars($b['ville']) : '';
                                    $region = isset($b['region']) ? htmlspecialchars($b['region']) : '';
                                    $categorie = isset($b['nom_categorie']) ? htmlspecialchars($b['nom_categorie']) : '';
                                    $type = isset($b['nom_type']) ? htmlspecialchars($b['nom_type']) : '';
                                    $unite = isset($b['unite']) ? htmlspecialchars($b['unite']) : '';
                                    $qte = isset($b['qte_besoin_ville']) ? (float)$b['qte_besoin_ville'] : 0;
                                    $prix = isset($b['prix_unitaire']) ? (float)$b['prix_unitaire'] : 0;
                                    $date = !empty($b['date_saisie']) ? date('d/m/Y', strtotime($b['date_saisie'])) : '';
                                    $montant = $qte * $prix;

                                   
                                    $catClass = 'bg-secondary';
                                    if (strcasecmp($categorie, 'Nature') === 0) $catClass = 'bg-success';
                                    elseif (strcasecmp($categorie, 'Matériaux') === 0) $catClass = 'bg-warning';
                                    elseif (strcasecmp($categorie, 'Argent') === 0) $catClass = 'bg-info';
                                ?>
                                <tr>
                                    <td><?= $ville ?></td>
                                    <td><?= $region ?></td>
                                    <td><span class="badge <?= $catClass ?>"><?= $categorie ?></span></td>
                                    <td><?= $type ?></td>
                                    <td><?= $unite ?></td>
                                    <td class="text-end"><?= number_format($qte, ($unite === 'kg' || $unite === 'L' ? 0 : 0), ',', ' ') ?></td>
                                    <td class="text-end"><?= number_format($prix, 0, ',', ' ') ?> Ar</td>
                                    <td class="text-end"><?= number_format($montant, 0, ',', ' ') ?> Ar</td>
                                    <td class="text-center"><?= $date ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="text-center">Aucun besoin trouvé.</td>
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
    <script src="js/app.js"></script>

<?php
// Capturer le contenu
$content = ob_get_clean();

// Inclure le template principal
include 'modele.php';
?>