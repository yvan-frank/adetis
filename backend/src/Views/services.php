<?php
/** @var array<int, array<string, mixed>> $poles */
?>

<section class="page-hero">
    <div class="container">
        <h1><?= te('services.title') ?></h1>
        <p><?= te('services.lead') ?></p>
    </div>
</section>

<section>
    <div class="container">
        <div class="poles-nav">
            <?php foreach ($poles as $pole): ?>
                <a href="<?= htmlspecialchars(lurl('/poles-expertise/' . $pole['slug'])) ?>"><?= htmlspecialchars($pole['shortTitle']) ?></a>
            <?php endforeach; ?>
        </div>

        <?php foreach ($poles as $pole): ?>
            <article class="pole pole--media">
                <div class="pole__media" style="background-image: url('<?= htmlspecialchars($pole['image']) ?>')"></div>
                <div class="pole__body">
                    <span class="pole__index"><?= te('pole.label', ['n' => $pole['number']]) ?></span>
                    <h3><?= htmlspecialchars($pole['title']) ?></h3>
                    <p><?= htmlspecialchars($pole['lead']) ?></p>
                    <a class="pole__link" href="<?= htmlspecialchars(lurl('/poles-expertise/' . $pole['slug'])) ?>"><?= te('services.discover') ?></a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="cta-banner">
    <div class="container cta-banner__inner">
        <div>
            <h2><?= te('services.cta.title') ?></h2>
            <p><?= te('services.cta.text') ?></p>
        </div>
        <a class="btn btn-primary" href="<?= lurl('/contact') ?>"><?= te('home.cta.button') ?></a>
    </div>
</section>
