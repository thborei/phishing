<?php if (isset($field)) : ?>
    <h2>Modifier un champ</h2>
<? else : ?>
    <h2>Créer un champ</h2>
<? endif; ?>

<div class="container">
    <form action="<?= !isset($field) ? '/campaigns/formulaire/create/'. $campaign->getId() : '/campaigns/formulaire/update/'.$field->getId() ?>" method="post">
    <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">Nome du champ</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="nom du field" name="name" value="<?= isset($campaign) ? htmlspecialchars($campaign->getName()) : '' ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type de formulaire</label>
            <select class="form-control" id="type" name="type">
                <option value="text" <?= isset($field) && $field->getType() === 'text' ? 'selected' : '' ?>>Texte</option>
                <option value="password" <?= isset($field) && $field->getType() === 'text' ? 'selected' : '' ?>>Mot de passe</option>
                <option value="date" <?= isset($field) && $field->getType() === 'date' ? 'selected' : '' ?>>Date</option>
                <option value="email" <?= isset($field) && $field->getType() === 'email' ? 'selected' : '' ?>>Email</option>
            </select>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><?= isset($field) ? 'Modifier' : 'Créer' ?></button>
            </div>
        </div>
    </form>
</div>