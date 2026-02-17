<?php
$base_url = Flight::get('flight.base_url');
$page_title = "Besoins restants - BNGRC";
ob_start();
?>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h4 mb-0">Besoins restants</h1>
      <small class="text-muted">Liste des besoins non satisfaits</small>
    </div>
    <?php
    use app\models\Utils;
    $utils = new Utils(Flight::db());
    $totalArgent = (float) $utils->getTotalArgentDisponible();
    $fmt_total = number_format($totalArgent, 0, ',', ' ') . ' Ar';
    ?>
    <div class="ms-3">
      <div class="p-2 bg-success text-white rounded small">
        Total dons (argent) disponibles : <strong><?= $fmt_total ?></strong>
      </div>
    </div>

    <div class="d-flex gap-2 align-items-center">
      <form method="get" class="m-0">
        <label for="filterVille" class="form-label mb-0 me-2 small">Filtrer par ville</label>
        <select id="filterVille" name="ville" class="form-select form-select-sm" onchange="this.form.submit()">
          <option value="0">Toutes les villes</option>
          <?php foreach ($ville as $v): ?>
            <option value="<?= (int)$v['id'] ?>"
              <?= (isset($selectedVille) && $selectedVille === (int)$v['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($v['nom']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover table-sm align-middle" id="besoinsTable">
      <thead class="table-light">
        <tr>
          <th>Ville</th>
          <th>Région</th>
          <th>Type</th>
          <th>Unité</th>
          <th class="text-end">Demande</th>
          <th class="text-end">Satisfait</th>
          <th class="text-end">Restant</th>
          <th class="text-end">Prix Unitaire</th>
          <th class="text-end">Valeur restant (Ar)</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($besoin) && is_array($besoin)): ?>
          <?php foreach ($besoin as $b):
            $id_besoin = isset($b['id_besoin']) ? (int)$b['id_besoin'] : 0;
            $id_ville = isset($b['id_ville']) ? (int)$b['id_ville'] : 0;
            $villeName = isset($b['ville']) ? $b['ville'] : '';
            $region = isset($b['region']) ? $b['region'] : '';
            $nom_type = isset($b['nom_type']) ? $b['nom_type'] : '';
            $unite = isset($b['unite']) ? $b['unite'] : '';
            $prix_unitaire = isset($b['prix_unitaire']) ? (float)$b['prix_unitaire'] : 0;
            $qte_demande = isset($b['qte_demande']) ? (float)$b['qte_demande'] : 0;
            $qte_satisfait = isset($b['qte_satisfait']) ? (float)$b['qte_satisfait'] : 0;
            $qte_restant = isset($b['qte_restant']) ? (float)$b['qte_restant'] : max(0, $qte_demande - $qte_satisfait);
            $valeur_restant_ar = isset($b['valeur_restant_ar']) ? (float)$b['valeur_restant_ar'] : (
              $unite === 'ar' ? $qte_restant : $qte_restant * $prix_unitaire
            );

            $fmt_qte_demande = number_format($qte_demande, 0, ',', ' ');
            $fmt_qte_satisfait = number_format($qte_satisfait, 0, ',', ' ');
            $fmt_qte_restant = number_format($qte_restant, 0, ',', ' ');
            $fmt_prix = $prix_unitaire ? number_format($prix_unitaire, 0, ',', ' ') . ' Ar' : '-';
            $fmt_valeur_restant = number_format($valeur_restant_ar, 0, ',', ' ') . ' Ar';
          ?>
            <tr>
              <td><?= htmlspecialchars($villeName) ?></td>
              <td><?= htmlspecialchars($region) ?></td>
              <td><?= htmlspecialchars($nom_type) ?></td>
              <td><?= htmlspecialchars($unite) ?></td>
              <td class="text-end"><?= $fmt_qte_demande ?></td>
              <td class="text-end"><?= $fmt_qte_satisfait ?></td>
              <td class="text-end"><?= $fmt_qte_restant ?></td>
              <td class="text-end"><?= $fmt_prix ?></td>
              <td class="text-end"><?= $fmt_valeur_restant ?></td>
              <td class="text-center">
                <?php if ($unite === 'ar'): ?>
                  <span class="text-muted small">Monétaire</span>
                <?php else: ?>
                  <button type="button"
                    class="btn btn-sm btn-outline-primary btn-acheter"
                    data-bs-toggle="modal"
                    data-bs-target="#acheterModal"
                    data-id-besoin="<?= $id_besoin ?>"
                    data-qte-restant="<?= $qte_restant ?>">Acheter</button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="10" class="text-center">Aucun besoin restant.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="acheterModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Acheter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="modalIdBesoin">



        <div class="mb-3">
          <label class="form-label">Quantité à acheter</label>
          <input id="qte_achat" type="number" min="1" step="1" class="form-control">
        </div>

        <div id="acheterAlert" class="alert d-none"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" id="btnConfirmAchat" class="btn btn-primary">
          Acheter
        </button>
      </div>

    </div>
  </div>
</div>


<script>
  (function() {
    const acheterModal = document.getElementById('acheterModal');
    const modalIdBesoin = document.getElementById('modalIdBesoin');
    const qteAchat = document.getElementById('qte_achat');
    const acheterAlert = document.getElementById('acheterAlert');

    document.querySelectorAll('.btn-acheter').forEach(btn => {
      btn.addEventListener('click', function() {
        const bid = this.getAttribute('data-id-besoin');
        const qteRestant = parseFloat(this.getAttribute('data-qte-restant')) || 0;

        modalIdBesoin.value = bid;
        qteAchat.max = qteRestant;
        qteAchat.value = Math.min(Math.max(1, Math.floor(qteRestant)), qteRestant) || 1;

        if (acheterAlert) {
          acheterAlert.classList.add('d-none');
          acheterAlert.textContent = '';
        }
      });
    });

    const acheterForm = document.getElementById('acheterForm');
    if (acheterForm) {
      acheterForm.addEventListener('submit', function(e) {
        const max = parseFloat(qteAchat.max) || 0;
        const val = parseFloat(qteAchat.value) || 0;
        if (val <= 0 || val > max) {
          e.preventDefault();
          if (acheterAlert) {
            acheterAlert.className = 'alert alert-danger';
            acheterAlert.textContent = 'Quantité invalide : doit être comprise entre 1 et ' + max;
            acheterAlert.classList.remove('d-none');
          } else {
            alert('Quantite invalide');
          }
          return false;
        }
      });
    }
  })();
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {

    const baseUrl = "<?= $base_url ?>".replace(/\/$/, '');
    const qteInput = document.getElementById('qte_achat');
    const modalIdInput = document.getElementById('modalIdBesoin');
    const modalQteRestant = document.getElementById('modal_qte_restant');
    const alertEl = document.getElementById('acheterAlert');
    const confirmBtn = document.getElementById('btnConfirmAchat');
    const modalEl = document.getElementById('acheterModal');

    document.querySelectorAll('.btn-acheter').forEach(btn => {
      btn.addEventListener('click', function() {
        const bid = this.dataset.idBesoin || this.getAttribute('data-id-besoin');
        const qteRestant = parseFloat(this.dataset.qteRestant || this.getAttribute('data-qte-restant')) || 0;

        modalIdInput.value = bid;
        modalQteRestant.value = qteRestant;
        qteInput.max = qteRestant;
        qteInput.value = qteRestant > 0 ? qteRestant : 0;

        hideAlert();
      });
    });

    confirmBtn.addEventListener('click', function() {

      hideAlert();

      const id_besoin = modalIdInput.value;
      const qte = parseFloat(qteInput.value) || 0;
      const max = parseFloat(qteInput.max) || 0;

      if (qte <= 0 || qte > max) {
        showError("Quantité invalide (max: " + max + ")");
        return;
      }

      confirmBtn.disabled = true;
      confirmBtn.textContent = "En cours...";

      const xhr = new XMLHttpRequest();
      xhr.open("POST", baseUrl + "/acheter", true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.setRequestHeader("Accept", "application/json");

      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {

          confirmBtn.disabled = false;
          confirmBtn.textContent = "Acheter";

          if (xhr.status >= 200 && xhr.status < 300) {

            let response;
            try {
              response = JSON.parse(xhr.responseText);
            } catch (e) {
              showError("Réponse JSON invalide");
              return;
            }

            if (response.success) {
              showSuccess(response.message || "Achat effectué");

              setTimeout(() => {
                bootstrap.Modal.getInstance(modalEl).hide();
                location.reload();
              }, 800);

            } else {
              showError(response.message || "Erreur");
            }

          } else {
            showError("Erreur serveur: " + xhr.status);
          }
        }
      };

      xhr.onerror = function() {
        confirmBtn.disabled = false;
        confirmBtn.textContent = "Acheter";
        showError("Erreur réseau");
      };

      xhr.send(JSON.stringify({
        id_besoin: id_besoin,
        qte: qte
      }));
    });

    function showError(msg) {
      alertEl.className = "alert alert-danger";
      alertEl.textContent = msg;
      alertEl.classList.remove("d-none");
    }

    function showSuccess(msg) {
      alertEl.className = "alert alert-success";
      alertEl.textContent = msg;
      alertEl.classList.remove("d-none");
    }

    function hideAlert() {
      alertEl.classList.add("d-none");
      alertEl.textContent = "";
    }

  });
</script>


<?php
$content = ob_get_clean();
include 'modele.php';
?>