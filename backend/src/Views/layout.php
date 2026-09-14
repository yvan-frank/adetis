<?php

use App\Core\Assets;
use App\Core\Seo;

$title = $pageTitle ?? 'ADETIS Engineering';
$description = $pageDescription ?? "ADETIS Engineering : cabinet d'ingénierie, bureau d'études CAO/DAO, recherche appliquée, équipements industriels et formation en Afrique Centrale et en France.";
$robots = $robots ?? 'index, follow';
$requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$canonicalUrl = Seo::absoluteUrl($requestPath);
$ogImageUrl = Seo::absoluteUrl($ogImage ?? '/assets/img/hero-industry.jpg');
/** @var array<int, array<string, mixed>> $jsonLd */
$jsonLdDocuments = array_merge([Seo::organizationJsonLd()], $jsonLd ?? []);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($description) ?>">
    <meta name="robots" content="<?= htmlspecialchars($robots) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
    <link rel="icon" type="image/png" href="/assets/img/logo-adetis.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="/assets/css/style.css">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="ADETIS Engineering">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="<?= htmlspecialchars($title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($description) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImageUrl) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($description) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImageUrl) ?>">

    <?php foreach ($jsonLdDocuments as $document): ?>
        <script type="application/ld+json"><?= json_encode($document, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
    <?php endforeach; ?>
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
