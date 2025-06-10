<h2>Liste des 10 derniers employés hameçonnés</h2>
<div class="table-responsive">
    <table>
        <thead>
            <tr class="Haut-Tableau">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mail</th>
                <th>Mot de passe</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td data-label="Nom"><?= htmlspecialchars($user->getJsonName()) ?></td>
                    <td data-label="Prénom"><?= htmlspecialchars($user->getJsonName()) ?></td>
                    <td data-label="Mail"><?= htmlspecialchars($user->getJsonMail()) ?></td>
                    <td data-label="Mot de passe"><?= htmlspecialchars($user->getJsonPassword()) ?></td>
                    <td data-label="Actions">
                        <a href="user/mail/<?= $user->getId()?>" class="bouton-campagne">Contacter</a><br>
                        <a href="list/<?= $user->getIduser() ?>" class="bouton-campagne">Liste</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>