<?php
$whyCards = [['🚀', 'network'], ['🛠️', 'expertise'], ['🌍', 'bridge'], ['🤝', 'support']];
$zones = ['cemac', 'france', 'germany', 'russia', 'belgium'];
$families = [['🏭', 'tech'], ['🎓', 'edu'], ['🏛️', 'public']];
?>
<section class="hero hero--media" style="background-image: linear-gradient(120deg, rgba(7,28,58,.94), rgba(11,46,92,.88) 55%, rgba(173,15,31,.55)), url('/assets/img/partnership-handshake.jpg')">
    <div class="container">
        <span class="hero__eyebrow"><?= te('partners.hero.eyebrow') ?></span>
        <h1><?= te('partners.hero.title') ?></h1>
        <p><?= te('partners.hero.text') ?></p>
        <div class="hero__actions">
            <a class="btn btn-primary" href="<?= lurl('/contact') ?>"><?= te('partners.become') ?></a>
            <a class="btn btn-outline" href="#typologie"><?= te('partners.hero.discover') ?></a>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <strong>5</strong>
                <span><?= te('partners.stat.zones') ?></span>
            </div>
            <div class="hero-stat">
                <strong>3</strong>
                <span><?= te('partners.stat.types') ?></span>
            </div>
            <div class="hero-stat">
                <strong>2</strong>
                <span><?= te('home.stat.sites') ?></span>
            </div>
            <div class="hero-stat">
                <strong>CEMAC</strong>
                <span><?= te('partners.stat.priority') ?></span>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= te('partners.why.eyebrow') ?></span>
            <h2><?= te('partners.why.title') ?></h2>
            <p><?= te('partners.why.text') ?></p>
        </div>
        <div class="grid grid-4">
            <?php foreach ($whyCards as [$icon, $k]): ?>
                <div class="feature-card">
                    <span class="feature-card__icon"><?= $icon ?></span>
                    <h3><?= te("partners.why.$k.title") ?></h3>
                    <p><?= te("partners.why.$k.text") ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="alt">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= te('partners.zones.eyebrow') ?></span>
            <h2><?= te('partners.zones.title') ?></h2>
            <p><?= te('partners.zones.text') ?></p>
        </div>
        <div class="grid grid-3">
            <?php foreach ($zones as $k): ?>
                <div class="card">
                    <h3>📍 <?= te("partners.zone.$k.title") ?></h3>
                    <p><?= te("partners.zone.$k.text") ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="typologie">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= te('partners.types.eyebrow') ?></span>
            <h2><?= te('partners.types.title') ?></h2>
        </div>
        <div class="grid grid-3">
            <?php foreach ($families as [$icon, $k]): ?>
                <div class="feature-card">
                    <span class="feature-card__icon"><?= $icon ?></span>
                    <h3><?= te("partners.type.$k.title") ?></h3>
                    <p><?= te("partners.type.$k.text") ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="alt">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= te('process.eyebrow') ?></span>
            <h2><?= te('partners.steps.title') ?></h2>
        </div>
        <div class="process">
            <?php foreach (['contact', 'study', 'formalise', 'launch'] as $i => $k): ?>
                <div class="process-step">
                    <span class="process-step__num"><?= $i + 1 ?></span>
                    <h3><?= te("partners.step.$k.title") ?></h3>
                    <p><?= te("partners.step.$k.text") ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-banner">
    <div class="container cta-banner__inner">
        <div>
            <h2><?= te('partners.cta.title') ?></h2>
            <p><?= te('partners.cta.text') ?></p>
        </div>
        <a class="btn btn-primary" href="<?= lurl('/contact') ?>"><?= te('partners.become') ?></a>
    </div>
</section>
