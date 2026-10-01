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
            <?php
            $langNames = ['fr' => 'Français', 'en' => 'English'];
            $langFlags = ['fr' => 'fr', 'en' => 'gb'];
            $currentLang = Lang::current();
            ?>
            <details class="lang-select" data-lang-select>
                <summary aria-label="<?= htmlspecialchars(t('nav.language')) ?>">
                    <img src="/assets/img/flags/<?= $langFlags[$currentLang] ?>.svg" alt="" width="22" height="16">
                    <span><?= htmlspecialchars($langNames[$currentLang]) ?></span>
                </summary>
                <ul class="lang-select__menu">
                    <?php foreach (array_keys(Lang::supported()) as $code): ?>
                        <li>
                            <a href="<?= htmlspecialchars(Lang::url(Lang::barePath(), $code)) ?>" hreflang="<?= $code ?>" lang="<?= $code ?>"<?= $code === $currentLang ? ' class="is-current" aria-current="true"' : '' ?>>
                                <img src="/assets/img/flags/<?= $langFlags[$code] ?>.svg" alt="" width="22" height="16">
                                <span><?= htmlspecialchars($langNames[$code]) ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </details>
        </nav>
    </div>
</header>
<div class="nav-backdrop" data-nav-backdrop hidden></div>
<script>
    (function () {
        // Menu de langue personnalisé (<details>) : fermeture au clic extérieur et à Échap.
        document.querySelectorAll('[data-lang-select]').forEach(function (select) {
            document.addEventListener('click', function (e) {
                if (!select.contains(e.target)) select.removeAttribute('open');
            });
            select.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    select.removeAttribute('open');
                    select.querySelector('summary').focus();
                }
            });
        });

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
