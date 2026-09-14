<?php use App\Core\Assets; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle ?? 'ADETIS Engineering') ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDescription ?? "ADETIS Engineering : cabinet d'ingénierie, bureau d'études CAO/DAO, recherche appliquée, équipements industriels et formation en Afrique Centrale et en France.") ?>">
    <link rel="icon" type="image/png" href="/assets/img/logo-adetis.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php require __DIR__ . '/partials/nav.php'; ?>
<main>
<?= $content() ?>
</main>
<?php require __DIR__ . '/partials/footer.php'; ?>
<?= Assets::islandsTags() ?>
</body>
</html>
