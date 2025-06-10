<h2>Liste des campagne</h2>

<a href="/campaigns/create" class="btn btn-primary">Créer</a>
<div class="table-responsive">
    <table>
        <thead>
            <tr class="Haut-Tableau">
                <th>Numéro de Campagne</th>
                <th>Nom de la campagne</th>
                <th>Lien de la Campagne</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($campaigns as $campaign): ?>
                <tr>
                    <td data-label="ID"><?= htmlspecialchars($campaign->getId()) ?></td>
                    <td data-label="Nom"><?= htmlspecialchars($campaign->getType()) ?></td>
                    <td data-label="URL"><?= htmlspecialchars($campaign -> getUrl()) ?>
                        <img src="<?= $campaign -> createQrcode($campaign -> getUrl(), $campaign -> getId()) ?>" alt="QR Code" class="popup-image">
                    </td>
                    <td data-label="Actions">
                        <a href="/campaigns/update/<?= htmlspecialchars($campaign->getId()) ?>" class="bouton-campagne"> Modifier</a><br>
                        <a href="/campaigns/results/<?= $campaign -> getId() ?>" class="bouton-campagne">Résultat</a><br>
                        <?php if ($campaign->getType() === 'custom'): ?>
                            <a href="/campaigns/formulaire/<?= $campaign -> getId() ?>" class="bouton-campagne">Formulaire </a>
                        <?php endif; ?>
                        <a href="#" onclick="confirmDelete(<?= htmlspecialchars($campaign->getId()) ?>)" class="bouton-campagne">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div id="deleteModal" class="modal" style="display: none;">
  <div class="modal-content">
    <p style="color: black">Es-tu sûr de vouloir supprimer cette campagne ? Cette action effacera toutes les données associées à cette campagne.</p><br>
    <button onclick="cancelDelete()">Annuler</button>
    <a id="confirmDeleteBtn" href="#" class="btn btn-danger">Confirmer la suppression</a>
  </div>
</div>

<style>
.modal {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}
.modal-content {
  background: white;
  padding: 1rem;
  border-radius: 8px;
  text-align: center;
}
</style>

<script>
function confirmDelete(id) {
  const modal = document.getElementById("deleteModal");
  modal.style.display = "flex";

  const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
  confirmDeleteBtn.href = "/campaigns/delete/" + id;
}

function cancelDelete() {
  const modal = document.getElementById("deleteModal");
  modal.style.display = "none";
}
</script>
