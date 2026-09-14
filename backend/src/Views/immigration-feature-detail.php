<?php
/** @var array<string, mixed> $feature */
/** @var array<int, array<string, mixed>> $others */
?>

<div class="breadcrumb">
    <div class="container">
        <a href="/">Accueil</a>
        <span>/</span>
        <a href="/poles-expertise">Nos pôles d'expertise</a>
        <span>/</span>
        <a href="/poles-expertise/immigration-etudes-france">Immigration &amp; Études en France</a>
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
            <a class="btn btn-accent" href="/poles-expertise/immigration-etudes-france/candidature?etape=<?= htmlspecialchars($feature['slug']) ?>">Être accompagné sur cette étape</a>
            <a class="btn btn-outline" href="/poles-expertise/immigration-etudes-france">Voir le pôle Immigration</a>
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
                <h3>Besoin d'un accompagnement personnalisé ?</h3>
                <p>Nos conseillers étudient votre situation et vous indiquent les étapes précises à suivre pour cette démarche.</p>
                <a class="btn btn-solid" href="/poles-expertise/immigration-etudes-france/candidature?etape=<?= htmlspecialchars($feature['slug']) ?>">Demander un accompagnement</a>
            </div>
            <div class="aside-card aside-card--muted">
                <h3>Autres étapes du pôle Immigration</h3>
                <ul class="aside-list">
                    <?php foreach ($others as $other): ?>
                        <li>
                            <a href="/poles-expertise/immigration-etudes-france/<?= htmlspecialchars($other['slug']) ?>">
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
            <span class="section-heading__eyebrow">Questions fréquentes</span>
            <h2>Ce que nos candidats nous demandent le plus</h2>
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
            <h2>Prêt à passer à l'étape suivante ?</h2>
            <p>Parlons de votre profil et de votre calendrier : nous vous indiquons la marche à suivre concrète pour <?= mb_strtolower($feature['title']) ?>.</p>
        </div>
        <a class="btn btn-primary" href="/poles-expertise/immigration-etudes-france/candidature?etape=<?= htmlspecialchars($feature['slug']) ?>">Candidater maintenant</a>
    </div>
</section>
