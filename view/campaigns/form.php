<?php if (isset($campaign)) : ?>
    <h2>Modifier une campagne</h2>
<? else : ?>
    <h2>Créer une campagne</h2>
<? endif; ?>

<div class="container">
    <form action="<?= !isset($campaign) ? '/campaigns/create' : '/campaigns/update/'.$campaign->getId() ?>" method="post">
        <div class="form-group row">
            <label for="url" class="col-sm-2 col-form-label">URL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="url" placeholder="URL de la campagne" name="url" value="<?= isset($campaign) ? htmlspecialchars($campaign->getUrl()) : '' ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="type">Type de la campagne</label>
            <select class="form-control" id="type" name="type">
                <option value="pre-defined" <?= isset($campaign) && $campaign->getType() === 'pre-defined' ? 'selected' : '' ?>>Pré-définie</option>
                <option value="custom" <?= isset($campaign) && $campaign->getType() === 'custom' ? 'selected' : '' ?>>Personnalisée</option>
            </select>
            <div id="predefinedFields" style="display: none; margin-top: 1rem;">
                <label for="predefinedOptions">Options prédéfinies :</label>
                <select class="form-control" id="predefinedOptions" name="predefinedOptions">
                    <option value="Facebook">Facebook</option>
                    <option value="Google">Google</option>
                </select>
            </div>
        </div>
        <div class="form-group" style="margin-top: 1rem;">
            <label for="Cible">Cible de la campagne</label>
            <select class="form-control" id="Cible" name="Cible">
                <option value="">-- Sélectionner --</option>
                <option value="service">Service</option>
                <option value="utilisateur">Utilisateur</option>
            </select>

            <div id="serviceFields" style="display: none; margin-top: 1rem;">
                <label for="serviceSelect">Sélectionnez un service :</label>
                <select class="form-control" id="serviceSelect" name="service">
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service->getId() ?>">
                            <?= htmlspecialchars($service->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="userFields" style="display: none; margin-top: 1rem;">
                <label for="userSelect">Sélectionnez un ou plusieurs utilisateurs :</label>
                <select class="form-control" id="userSelect" name="users[]" multiple>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->getId() ?>">
                            <?= htmlspecialchars($user->getName() . ' ' . $user->getFirstname()) ?> (<?= htmlspecialchars($user->getEmail()) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary"><?= isset($campaign) ? 'Modifier' : 'Créer' ?></button>
            </div>
        </div>
    </form>
</div>

<script>
function toggleSecondSelect() {
    const typeSelect = document.getElementById("type");
    const secondSelect = document.getElementById("predefinedFields");
    const secondSelectOptions = document.getElementById("predefinedOptions");

    if (typeSelect.value === "pre-defined") {
        secondSelect.style.display = "block";
        secondSelectOptions.disabled = false;
    } else {
        secondSelect.style.display = "none";
        secondSelectOptions.disabled = true;
    }
}
document.getElementById("type").addEventListener("change", toggleSecondSelect);
// Exécuter au chargement pour afficher correctement selon la valeur déjà sélectionnée
document.addEventListener("DOMContentLoaded", toggleSecondSelect);
</script>
<script>
function toggleTargetFields() {
    const cibleSelect = document.getElementById("Cible");
    const serviceFields = document.getElementById("serviceFields");
    const userFields = document.getElementById("userFields");

    if (cibleSelect.value === "service") {
        serviceFields.style.display = "block";
        userFields.style.display = "none";
    } else if (cibleSelect.value === "utilisateur") {
        serviceFields.style.display = "none";
        userFields.style.display = "block";
    } else {
        serviceFields.style.display = "none";
        userFields.style.display = "none";
    }
}

document.getElementById("Cible").addEventListener("change", toggleTargetFields);
document.addEventListener("DOMContentLoaded", toggleTargetFields);
</script>