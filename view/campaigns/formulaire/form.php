<?php if (isset($campaign)) : ?>
    <h2>Modifier un formulaire</h2>
<? else : ?>
    <h2>Créer un formulaire</h2>
<? endif; ?>

<div class="container">
    <form action="<?= !isset($field) ? '/campaigns/formulaire/create' : '/campaigns/formulaire/update/'.$field->getId() ?>" method="post">
        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">URL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="url" placeholder="URL de la campagne" name="url" value="<?= isset($campaign) ? htmlspecialchars($campaign->getUrl()) : '' ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type de formulaire</label>
            <select class="form-control" id="type" name="type">
                <option value="pre-defined" <?= isset($campaign) && $campaign->getType() === 'pre-defined' ? 'selected' : '' ?>>Pré-définie</option>
                <option value="custom" <?= isset($campaign) && $campaign->getType() === 'custom' ? 'selected' : '' ?>>Personnalisée</option>
            </select>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><?= isset($campaign) ? 'Modifier' : 'Créer' ?></button>
            </div>
        </div>
    </form>
</div>