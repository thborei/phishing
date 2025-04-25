<h2>Liste des Champs</h2>

<a href="/campaigns/formulaire/create/<?= htmlspecialchars($campaign->getId()) ?>" class="btn btn-primary">Ajouter un formulaire</a>
<div class="table-responsive">
    <table>
        <thead>
            <tr class="Haut-Tableau">
                <th>Numéro du Champ</th>
                <th>Nom du Champ</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fields as $field): ?>
                <tr>
                    <td data-label="ID"><?= htmlspecialchars($field->getId()) ?></td>
                    <td data-label="Nom"><?= htmlspecialchars($field->getName()) ?></td>
                    <td data-label="Type"><?= htmlspecialchars($field -> getType()) ?></td>
                    <td data-label="Actions">
                        <a href="/campaigns/formulaire/update/<?= htmlspecialchars($field->getId()) ?>"> Modifier</a><br>
                        <a href="/campaigns/formulaire/delete/<?= htmlspecialchars($field->getId()) ?>"> Supprimer</a><br>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>