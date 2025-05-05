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
                <th>Hexadécimal</th>
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
                    </td>
                    <td><?= $campaign->getHex() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
