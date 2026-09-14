<?php
/** @var array<int, array<string, mixed>> $poles */
?>

<section class="page-hero">
    <div class="container">
        <h1>Nos pôles d'expertise</h1>
        <p>Une offre intégrée qui couvre la conception, la production, l'approvisionnement en équipements, la formation et la mobilité internationale.</p>
    </div>
</section>

<section>
    <div class="container">
        <div class="poles-nav">
            <?php foreach ($poles as $pole): ?>
                <a href="/poles-expertise/<?= htmlspecialchars($pole['slug']) ?>"><?= htmlspecialchars($pole['shortTitle']) ?></a>
            <?php endforeach; ?>
        </div>

        <?php foreach ($poles as $pole): ?>
            <article class="pole pole--media">
                <div class="pole__media" style="background-image: url('<?= htmlspecialchars($pole['image']) ?>')"></div>
                <div class="pole__body">
                    <span class="pole__index">Pôle <?= $pole['number'] ?></span>
                    <h3><?= htmlspecialchars($pole['title']) ?></h3>
                    <p><?= htmlspecialchars($pole['lead']) ?></p>
                    <a class="pole__link" href="/poles-expertise/<?= htmlspecialchars($pole['slug']) ?>">Découvrir ce pôle →</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="cta-banner">
    <div class="container cta-banner__inner">
        <div>
            <h2>Un besoin qui mêle plusieurs pôles ?</h2>
            <p>Nos équipes pluridisciplinaires construisent avec vous une réponse sur mesure, quel que soit votre projet.</p>
        </div>
        <a class="btn btn-primary" href="/contact">Nous contacter</a>
    </div>
</section>
