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
                    <td data-label="Nom"><?= htmlspecialchars($user->getName()) ?></td>
                    <td data-label="Prénom"><?= htmlspecialchars($user->getFirstname()) ?></td>
                    <td data-label="Mail"><?= htmlspecialchars($user->getMail()) ?></td>
                    <td data-label="Mot de passe"><?= htmlspecialchars($user->getPassword()) ?></td>
                    <td data-label="Actions">
                        <a href=""> Contacter</a><br>
                        <a href="list/<?= $user->getIduser() ?>">Liste</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>