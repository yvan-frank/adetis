<?php use App\Core\Assets; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle ?? 'App') ?></title>
</head>
<body>
<?= $content() ?>
<?= Assets::islandsTags() ?>
</body>
</html>
