<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="/style/custom.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
  <div class="login-box">
    <h1>Test</h1>
    <p>Veuillez remplir tous les champs</p>
    <?php foreach ($fields as $field): ?>
      <input type="<?= $field->getType()?>" placeholder="<?= htmlspecialchars($field->getName()) ?>" />
    <?php endforeach; ?>
    <button>ログイン</button>
    <a href="#">ストアフロントに戻る</a>
  </div>
</div>
</body>
</html>