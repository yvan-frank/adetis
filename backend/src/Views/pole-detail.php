<?php
/** @var array<string, mixed> $pole */
/** @var array<int, array<string, mixed>> $others */
$isImmigration = $pole['slug'] === 'immigration-etudes-france';
$primaryCtaHref = $isImmigration ? '/poles-expertise/immigration-etudes-france/candidature' : '/contact';
$primaryCtaLabel = $isImmigration ? 'Candidater à un accompagnement' : 'Demander un devis';
?>

<div class="breadcrumb">
    <div class="container">
        <a href="/">Accueil</a>
        <span>/</span>
        <a href="/poles-expertise">Nos pôles d'expertise</a>
        <span>/</span>
        <span class="is-current"><?= htmlspecialchars($pole['shortTitle']) ?></span>
    </div>
</div>

<section class="hero hero--pole" style="background-image: linear-gradient(120deg, rgba(7,28,58,.92), rgba(11,46,92,.86) 55%, rgba(26,74,138,.78)), url('<?= htmlspecialchars($pole['image']) ?>')">
    <div class="container">
        <span class="hero__eyebrow"><?= htmlspecialchars($pole['eyebrow']) ?></span>
        <h1><?= htmlspecialchars($pole['title']) ?></h1>
        <p><?= htmlspecialchars($pole['lead']) ?></p>
        <div class="hero__actions">
            <a class="btn btn-accent" href="<?= htmlspecialchars($primaryCtaHref) ?>"><?= htmlspecialchars($primaryCtaLabel) ?></a>
            <a class="btn btn-outline" href="/poles-expertise">Voir tous les pôles</a>
        </div>

        <div class="hero-stats">
            <?php foreach ($pole['stats'] as $stat): ?>
                <div class="hero-stat">
                    <strong><?= htmlspecialchars($stat['value']) ?></strong>
                    <span><?= htmlspecialchars($stat['label']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow">Ce que nous faisons</span>
            <h2>Une expertise complète, taillée pour vos projets</h2>
            <p>Chaque mission est pilotée par des ingénieurs expérimentés, avec un souci constant de qualité, de délai et de conformité.</p>
        </div>
        <div class="grid grid-3 feature-grid">
            <?php foreach ($pole['features'] as $feature): ?>
                <?php if (!empty($feature['slug'])): ?>
                    <a class="feature-card feature-card--link" href="/poles-expertise/<?= htmlspecialchars($pole['slug']) ?>/<?= htmlspecialchars($feature['slug']) ?>">
                        <span class="feature-card__icon"><?= $feature['icon'] ?></span>
                        <h3><?= htmlspecialchars($feature['title']) ?></h3>
                        <p><?= htmlspecialchars($feature['desc']) ?></p>
                        <span class="feature-card__cta">En savoir plus →</span>
                    </a>
                <?php else: ?>
                    <div class="feature-card">
                        <span class="feature-card__icon"><?= $feature['icon'] ?></span>
                        <h3><?= htmlspecialchars($feature['title']) ?></h3>
                        <p><?= htmlspecialchars($feature['desc']) ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($pole['tags'])): ?>
            <div class="pole-tags">
                <p class="pole-tags__label"><strong><?= htmlspecialchars($pole['tagsLabel']) ?> :</strong></p>
                <ul class="tag-list">
                    <?php foreach ($pole['tags'] as $tag): ?>
                        <li><?= htmlspecialchars($tag) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="alt">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow">Notre méthode</span>
            <h2>Un accompagnement en 4 étapes claires</h2>
        </div>
        <div class="process">
            <?php foreach ($pole['process'] as $i => $step): ?>
                <div class="process-step">
                    <span class="process-step__num"><?= $i + 1 ?></span>
                    <h3><?= htmlspecialchars($step['title']) ?></h3>
                    <p><?= htmlspecialchars($step['desc']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-banner">
    <div class="container cta-banner__inner">
        <div>
            <h2>Parlons de votre projet</h2>
            <p>Notre équipe vous répond sous 48h pour évaluer votre besoin et vous proposer la meilleure approche.</p>
        </div>
        <a class="btn btn-primary" href="<?= htmlspecialchars($primaryCtaHref) ?>"><?= $isImmigration ? 'Candidater maintenant' : 'Nous contacter' ?></a>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow">Aller plus loin</span>
            <h2>Découvrir nos autres pôles</h2>
        </div>
        <div class="grid grid-4 poles-switch">
            <?php foreach ($others as $other): ?>
                <a class="poles-switch__item" href="/poles-expertise/<?= htmlspecialchars($other['slug']) ?>">
                    <span class="poles-switch__index">Pôle <?= $other['number'] ?></span>
                    <h3><?= htmlspecialchars($other['shortTitle']) ?></h3>
                    <span class="poles-switch__link">Découvrir →</span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
