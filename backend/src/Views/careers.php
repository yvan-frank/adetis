<section class="page-hero">
    <div class="container">
        <h1><?= te('careers.title') ?></h1>
        <p><?= te('careers.lead') ?></p>
    </div>
</section>

<section>
    <div class="container">
        <div class="grid grid-2">
            <div class="card">
                <h3><?= te('careers.reinsertion.title') ?></h3>
                <p><?= te('careers.reinsertion.text') ?></p>
            </div>
            <div class="card">
                <h3><?= te('careers.inclusion.title') ?></h3>
                <p><?= te('careers.inclusion.text') ?></p>
            </div>
        </div>
    </div>
</section>

<section class="alt">
    <div class="container">
        <div class="hero__actions" style="justify-content:center">
            <a class="btn btn-accent" href="<?= lurl('/contact') ?>"><?= te('careers.cta') ?></a>
        </div>
    </div>
</section>
