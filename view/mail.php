<h2>Envoyer un mail à <?= htmlspecialchars($user->getName()) ?></h2>

<form method="post" action="/mail/<?= $user->getId() ?>/send">
    <div class="form-group">
        <label for="subject">Objet :</label>
        <input type="text" id="subject" name="subject" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="body">Message :</label>
        <textarea id="body" name="body" class="form-control" rows="6" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
