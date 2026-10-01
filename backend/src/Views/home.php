<?php
$e = static fn (string $key): string => htmlspecialchars(t($key));

$poleCards = [
    ['bureau-etudes-methodes', 'home.pole.bem'],
    ['recherche-appliquee', 'home.pole.rech'],
    ['boostmarket', 'home.pole.boost'],
    ['formation-conferences', 'home.pole.form'],
    ['immigration-etudes-france', 'home.pole.immi'],
];
$whyCards = [['🎯', 'integrated'], ['🌍', 'bridge'], ['⚡', 'single'], ['🤝', 'network']];
?>
<section class="hero hero--media" style="--hero-img: url('/assets/img/hero-industry.jpg')">
    <div class="container">
        <span class="hero__eyebrow"><?= $e('home.hero.eyebrow') ?></span>
        <h1><?= $e('home.hero.title') ?></h1>
        <p><?= $e('home.hero.text') ?></p>
        <div class="hero__actions">
            <a class="btn btn-primary" href="<?= lurl('/poles-expertise') ?>"><?= $e('home.hero.cta_poles') ?></a>
            <a class="btn btn-outline" href="<?= lurl('/contact') ?>"><?= $e('home.hero.cta_contact') ?></a>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <strong>5</strong>
                <span><?= $e('home.stat.poles') ?></span>
            </div>
            <div class="hero-stat">
                <strong>2</strong>
                <span><?= $e('home.stat.sites') ?></span>
            </div>
            <div class="hero-stat">
                <strong>CEMAC</strong>
                <span><?= $e('home.stat.zone') ?></span>
            </div>
            <div class="hero-stat">
                <strong>2025–2035</strong>
                <span><?= $e('home.stat.horizon') ?></span>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= $e('home.quick.eyebrow') ?></span>
            <h2><?= $e('home.quick.title') ?></h2>
            <p><?= $e('home.quick.text') ?></p>
        </div>
        <div class="grid grid-4">
            <?php foreach ($poleCards as [$slug, $k]): ?>
                <div class="card card--media">
                    <div class="card__media" style="background-image: url('/assets/img/poles/<?= $slug ?>.jpg')"></div>
                    <h3><?= $e("$k.title") ?></h3>
                    <p><?= $e("$k.text") ?></p>
                    <a href="<?= lurl("/poles-expertise/$slug") ?>"><?= $e('home.more') ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="alt">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= $e('home.why.eyebrow') ?></span>
            <h2><?= $e('home.why.title') ?></h2>
            <p><?= $e('home.why.text') ?></p>
        </div>
        <div class="grid grid-4">
            <?php foreach ($whyCards as [$icon, $k]): ?>
                <div class="feature-card">
                    <span class="feature-card__icon"><?= $icon ?></span>
                    <h3><?= $e("home.why.$k.title") ?></h3>
                    <p><?= $e("home.why.$k.text") ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section>
    <div class="container split">
        <div class="split__media" style="background-image: url('/assets/img/partnership-handshake.jpg')"></div>
        <div class="split__body">
            <div class="section-heading">
                <span class="section-heading__eyebrow"><?= $e('home.reach.eyebrow') ?></span>
                <h2><?= $e('home.reach.title') ?></h2>
                <p><?= $e('home.reach.text') ?></p>
            </div>
            <div class="hero__actions">
                <a class="btn btn-solid" href="<?= lurl('/partenaires') ?>"><?= $e('home.reach.cta') ?></a>
            </div>
        </div>
    </div>
</section>

<section class="cta-banner">
    <div class="container cta-banner__inner">
        <div>
            <h2><?= $e('home.cta.title') ?></h2>
            <p><?= $e('home.cta.text') ?></p>
        </div>
        <a class="btn btn-primary" href="<?= lurl('/contact') ?>"><?= $e('home.cta.button') ?></a>
    </div>
</section>
