<!-- Affiche les données envoyé par un utilisateurs pour toutes les campagne -->
<!-- <h3>
</h3> -->
<h2>Champs renseignés par l'utilisateur</h2>

<div class="table-responsive">
    <table>
        <thead>
            <tr class="Haut-Tableau">
                <th>Nom renseigné</th>
                <th>Mot de passe renseigné</th>
                <th>Mail renseigné</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $dat): ?>
                <?php var_dump($dat); ?>
                <tr>
                    <td data-label="Nom renseigné"><?= htmlspecialchars($dat->getJsonName()) ?></td>
                    <td data-label="Mot de passe renseigné"><?= htmlspecialchars($dat->getJsonPassword()) ?></td>
                    <td data-label="Mail renseigné"><?= htmlspecialchars($dat->getJsonMail()) ?></td>
                    <td data-label="Date"><?= htmlspecialchars($dat->getDate()) ?></td>
                    <td data-label="Action">
                            <a href="">Utilisateur</a><br>
                            <a href="/campagn/<?= htmlspecialchars($dat->getIdcamp()) ?>">Campagne</a>                        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
