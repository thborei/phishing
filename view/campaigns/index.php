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
                        <a href="/campaigns/results/<?= $campaign -> getId() ?>">Résultat</a>
                        <?php if ($campaign->getType() === 'custom'): ?>
                            <a href="/campaigns/formulaire/<?= $campaign -> getId() ?>">Formulaire</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>