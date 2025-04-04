<h2>Liste des campagne</h2>

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
                    <td data-label="Nom"><?= htmlspecialchars($campagn->getId()) ?></td>
                    <td data-label="Prénom"><?= htmlspecialchars($campagn->getType()) ?></td>
                    <td data-label="Mail"><?= htmlspecialchars($campagn -> getUrl()) ?></td>
                    <td data-label="Actions">
                        <a href=""> Contacter</a><br>
                        <a href="campagn/<?= $campagn -> getId() ?>">Résultat</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>