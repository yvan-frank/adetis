<section class="page-hero">
    <div class="container">
        <h1><?= te('about.title') ?></h1>
        <p><?= te('about.lead') ?></p>
    </div>
</section>

<section>
    <div class="container">
        <div class="grid grid-2">
            <div class="card">
                <h3><?= te('about.vision.title') ?></h3>
                <p><?= te('about.vision.text') ?></p>
            </div>
            <div class="card">
                <h3><?= te('about.ambition.title') ?></h3>
                <p><?= te('about.ambition.text') ?></p>
            </div>
        </div>
    </div>
</section>

<section class="alt">
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= te('about.offices.eyebrow') ?></span>
            <h2><?= te('about.offices.title') ?></h2>
            <p><?= te('about.offices.text') ?></p>
        </div>
        <div class="grid grid-2">
            <?php require __DIR__ . '/partials/offices.php'; ?>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-heading">
            <span class="section-heading__eyebrow"><?= te('about.team.eyebrow') ?></span>
            <h2><?= te('about.team.title') ?></h2>
        </div>
        <div class="grid grid-3">
            <div class="card">
                <h3>M. TAKENDO NJANJO Dieudonné</h3>
                <p><?= te('about.team.founder') ?></p>
            </div>
            <div class="card">
                <h3>M. KURT GRAF</h3>
                <p><?= te('about.team.partner') ?></p>
            </div>
            <div class="card">
                <h3>M. NJONKOU Isaac</h3>
                <p><?= te('about.team.manager') ?></p>
            </div>
        </div>
    </div>
</section>
