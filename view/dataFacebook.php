<h2>Liste des employé hameçonnée pour la campagne numero <?= $id ?></h2>

<div class="table-responsive">
    <table>
        <thead>
            <tr class="Haut-Tableau">
                <th>Date</th>
                <th>Mail</th>
                <th>Mot de passe</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Data as $dat): ?>
                <tr>
                    <td data-label="Nom"><?= $dat->getdate() ?></td>
                    <td data-label="Mail"><?= $dat->getJsonMail() ?></td>
                    <td data-label="Mot de passe"><?= $dat->getJsonPassword() ?></td>
                    <td data-label="Actions">
                        <a href=""> Contacter</a><br>
                        <a href="/list/<?= $dat -> getIduser() ?>">Liste</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>