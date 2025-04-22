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
            <?php foreach ($campagns as $campagn): ?>
                <tr>
                    <td data-label="ID"><?= htmlspecialchars($campagn->getId()) ?></td>
                    <td data-label="Nom"><?= htmlspecialchars($campagn->getType()) ?></td>
                    <td data-label="URL"><?= htmlspecialchars($campagn -> getUrl()) ?></td>
                    <td data-label="Actions">
                        <a href="/campaigns/edit/<?= htmlspecialchars($campagn -> id) ?>"> Modifier</a><br>
                        <a href="/campaigns/results/<?= $campagn -> getId() ?>">Résultat</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>