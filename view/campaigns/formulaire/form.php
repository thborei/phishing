<?php if (isset($campaign)) : ?>
    <h2>Modifier un formulaire</h2>
<? else : ?>
    <h2>Créer un formulaire</h2>
<? endif; ?>

<div class="container">
    <form action="<?= !isset($field) ? '/campaigns/formulaire/create' : '/campaigns/formulaire/update/'.$field->getId() ?>" method="post">
        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">Nome du Formulaire</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="nom du field" name="name" value="<?= isset($field) ? htmlspecialchars($field->getName()) : '' ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type de formulaire</label>
            <select class="form-control" id="type" name="type">
                <option value="date" <?= isset($field) && $field->getType() === 'date' ? 'selected' : '' ?>>Date</option>
                <option value="email" <?= isset($field) && $field->getType() === 'email' ? 'selected' : '' ?>>email</option>
            </select>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><?= isset($field) ? 'Modifier' : 'Créer' ?></button>
            </div>
        </div>
    </form>
</div>