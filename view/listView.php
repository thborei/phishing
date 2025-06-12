<h2>Champs renseignés par l'utilisateur</h2>

<div class="table-responsive">
    <table>
        <thead>
            <tr class="Haut-Tableau">
                <th>Nom renseigné</th>
                <th>Numéro de campagne</th>
                <th>Mail renseigné</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $dat): ?>
                <tr>
                    <td data-label="Nom renseigné"><?= htmlspecialchars($dat->getJsonName()) ?></td>
                    <td data-label="Mot de passe renseigné"><?= htmlspecialchars($dat->getIdcamp()) ?></td>
                    <td data-label="Mail renseigné"><?= htmlspecialchars($dat->getJsonMail()) ?></td>
                    <td data-label="Date"><?= htmlspecialchars($dat->getDate()) ?></td>
                    <td data-label="Action">
                            <a href="/campagn/<?= htmlspecialchars($dat->getIdcamp()) ?> " class="bouton-campagne">Campagne</a>                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
