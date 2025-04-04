<?php
require_once 'header.html';
echo "Hello World!"
?>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>PV</th>
        <th>PVMax</th>
        <th>Force</th>
        <th>Dé</th>
        <th>Chance</th>
        <th>XP</th>
        <th>Argent</th>
        <th>Avatar</th>
        <th>Actions</th>
    </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
            <td>
                <!-- <a href="/personnage/<?= $char->getId() ?>">Modifier</a> -->
                <!-- <a href="/delete/<?= $char->getId() ?>" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a> -->
            </td>
        </tr>
</table>