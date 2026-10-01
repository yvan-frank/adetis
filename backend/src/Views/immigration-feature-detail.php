<?php
/** @var array<string, mixed> $feature */
/** @var array<int, array<string, mixed>> $others */
$applyUrl = htmlspecialchars(lurl('/poles-expertise/immigration-etudes-france/candidature?etape=' . $feature['slug']));
$poleUrl = htmlspecialchars(lurl('/poles-expertise/immigration-etudes-france'));
?>

<div class="breadcrumb">
    <div class="container">
        <a href="<?= htmlspecialchars(lurl('/')) ?>"><?= te('nav.home') ?></a>
        <span>/</span>
        <a href="<?= htmlspecialchars(lurl('/poles-expertise')) ?>"><?= te('nav.services') ?></a>
        <span>/</span>
        <a href="<?= $poleUrl ?>"><?= te('pole.immigration_name') ?></a>
        <span>/</span>
        <span class="is-current"><?= htmlspecialchars($feature['title']) ?></span>
    </div>
</div>

<section class="hero hero--pole">
    <div class="container">
        <span class="hero__eyebrow"><?= $feature['icon'] ?> <?= htmlspecialchars($feature['eyebrow']) ?></span>
        <h1><?= htmlspecialchars($feature['title']) ?></h1>
        <p><?= htmlspecialchars($feature['lead']) ?></p>
        <div class="hero__actions">
            <a class="btn btn-accent" href="<?= $applyUrl ?>"><?= te('feature.cta.step') ?></a>
            <a class="btn btn-outline" href="<?= $poleUrl ?>"><?= te('feature.cta.pole') ?></a>
        </div>

        <div class="hero-stats">
            <?php foreach ($feature['stats'] as $stat): ?>
                <div class="hero-stat">
                    <strong><?= htmlspecialchars($stat['value']) ?></strong>
                    <span><?= htmlspecialchars($stat['label']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section>
    <div class="container article-layout">
        <div class="article-body">
            <?php foreach ($feature['sections'] as $section): ?>
                <div class="article-section">
                    <h2><?= htmlspecialchars($section['heading']) ?></h2>
                    <?php foreach ($section['paragraphs'] as $paragraph): ?>
                        <p><?= htmlspecialchars($paragraph) ?></p>
                    <?php endforeach; ?>
                    <?php if (!empty($section['items'])): ?>
                        <ul class="check-list">
                            <?php foreach ($section['items'] as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <aside class="article-aside">
            <div class="aside-card">
                <h3><?= te('feature.aside.title') ?></h3>
                <p><?= te('feature.aside.text') ?></p>
                <a class="btn btn-solid" href="<?= $applyUrl ?>"><?= te('feature.aside.cta') ?></a>
            </div>
            <div class="aside-card aside-card--muted">
                <h3><?= te('feature.others') ?></h3>
                <ul class="aside-list">
                    <?php foreach ($others as $other): ?>
                        <li>
                            <a href="<?= htmlspecialchars(lurl('/poles-expertise/immigration-etudes-france/' . $other['slug'])) ?>">
                                <span><?= $other['icon'] ?></span> <?= htmlspecialchars($other['title']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
    </div>
</section>

<?php if (!empty($feature['faq'])): ?>
<section class="alt">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= te('feature.faq.eyebrow') ?></span>
            <h2><?= te('feature.faq.title') ?></h2>
        </div>
        <div class="faq-list">
            <?php foreach ($feature['faq'] as $item): ?>
                <details class="faq-item">
                    <summary><?= htmlspecialchars($item['q']) ?></summary>
                    <p><?= htmlspecialchars($item['a']) ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="cta-banner">
    <div class="container cta-banner__inner">
        <div>
            <h2><?= te('feature.cta.title') ?></h2>
            <p><?= te('feature.cta.text', ['title' => mb_strtolower($feature['title'])]) ?></p>
        </div>
        <a class="btn btn-primary" href="<?= $applyUrl ?>"><?= te('pole.cta.apply_now') ?></a>
    </div>
</section>
