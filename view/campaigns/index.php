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
                    <td data-label="URL"><?= htmlspecialchars($campaign -> getUrl()) ?></td>
                    <td data-label="Actions">
                        <a href="/campaigns/update/<?= htmlspecialchars($campaign->getId()) ?>"> Modifier</a><br>
                        <a href="/campaigns/results/<?= $campaign -> getId() ?>">Résultat</a><br>
                        <button id="openPopupBtn">Afficher l'image</button>
                        <div id="popup" class="popup" display="none">
                            <div class="popup-content">
                                <span id="closePopupBtn" class="close-btn">&times;</span>
                                <img src="<?= $campaign -> createQrcode($campaign -> getUrl(), $campaign -> getId()) ?>" alt="QR Code" class="popup-image">
                            </div>
                        </div>
                        <?php if ($campaign->getType() === 'custom'): ?>
                            <a href="/campaigns/formulaire/<?= $campaign -> getId() ?>">Formulaire</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
const openPopupBtn = document.getElementById("openPopupBtn");
const popup = document.getElementById("popup");
const closePopupBtn = document.getElementById("closePopupBtn");

// Ouvre la pop-up lorsque le bouton est cliqué
openPopupBtn.addEventListener("click", function() {
    popup.style.display = "flex"; // Affiche la pop-up
});

// Ferme la pop-up lorsque le bouton de fermeture est cliqué
closePopupBtn.addEventListener("click", function() {
    popup.style.display = "none"; // Cache la pop-up
});

// Ferme la pop-up si l'utilisateur clique en dehors de la fenêtre modale
window.addEventListener("click", function(event) {
    if (event.target === popup) {
        popup.style.display = "none"; // Cache la pop-up
    }
});
</script>