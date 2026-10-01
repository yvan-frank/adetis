<?php
use App\Core\Lang;

/** @var string|null $activeNav */
$navItems = [
    'home' => ['/', t('nav.home')],
    'about' => ['/a-propos', t('nav.about')],
    'services' => ['/poles-expertise', t('nav.services')],
    'partners' => ['/partenaires', t('nav.partners')],
    'careers' => ['/engagement-social', t('nav.careers')],
    'contact' => ['/contact', t('nav.contact')],
];
?>
<header class="site-header">
    <div class="site-header__bar container">
        <a class="brand" href="<?= htmlspecialchars(lurl('/')) ?>">
            <img src="/assets/img/logo-adetis.png" alt="ADETIS Engineering">
            <span class="brand__name">ADETIS<small>Engineering</small></span>
        </a>

        <button type="button" class="nav-toggle" aria-label="<?= htmlspecialchars(t('nav.open')) ?>" aria-expanded="false" aria-controls="main-nav" data-nav-toggle>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
            <span class="nav-toggle__bar"></span>
        </button>

        <nav class="main-nav" id="main-nav" data-nav>
            <button type="button" class="nav-close" aria-label="<?= htmlspecialchars(t('nav.close')) ?>" data-nav-close>&times;</button>
            <?php foreach ($navItems as $key => [$href, $label]): ?>
                <a href="<?= htmlspecialchars(lurl($href)) ?>"<?= ($activeNav ?? '') === $key ? ' class="is-active"' : '' ?>><?= htmlspecialchars($label) ?></a>
            <?php endforeach; ?>
            <span class="lang-switch" role="group" aria-label="<?= htmlspecialchars(t('nav.language')) ?>">
                <?php foreach (array_keys(Lang::supported()) as $code): ?>
                    <a href="<?= htmlspecialchars(Lang::url(Lang::barePath(), $code)) ?>" hreflang="<?= $code ?>" lang="<?= $code ?>"<?= $code === Lang::current() ? ' class="is-current" aria-current="true"' : '' ?>><?= strtoupper($code) ?></a>
                <?php endforeach; ?>
            </span>
        </nav>
    </div>
</header>
<div class="nav-backdrop" data-nav-backdrop hidden></div>
<script>
    (function () {
        var toggle = document.querySelector('[data-nav-toggle]');
        var nav = document.querySelector('[data-nav]');
        var backdrop = document.querySelector('[data-nav-backdrop]');
        var closeBtn = document.querySelector('[data-nav-close]');
        if (!toggle || !nav || !backdrop) return;

        function closeNav() {
            nav.classList.remove('is-open');
            toggle.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('nav-open');
            backdrop.addEventListener('transitionend', function hide() {
                if (!nav.classList.contains('is-open')) backdrop.hidden = true;
                backdrop.removeEventListener('transitionend', hide);
            });
            backdrop.classList.remove('is-visible');
        }

        function openNav() {
            backdrop.hidden = false;
            // Force reflow so the transition runs from hidden -> visible.
            void backdrop.offsetWidth;
            nav.classList.add('is-open');
            toggle.classList.add('is-open');
            toggle.setAttribute('aria-expanded', 'true');
            document.body.classList.add('nav-open');
            backdrop.classList.add('is-visible');
        }

        toggle.addEventListener('click', function () {
            if (nav.classList.contains('is-open')) closeNav(); else openNav();
        });

        backdrop.addEventListener('click', closeNav);

        if (closeBtn) closeBtn.addEventListener('click', closeNav);

        nav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeNav);
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('is-open')) closeNav();
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 760 && nav.classList.contains('is-open')) closeNav();
        });
    })();
</script>
