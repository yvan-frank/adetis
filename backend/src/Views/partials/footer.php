<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4>ADETIS Engineering</h4>
                <p><?= htmlspecialchars(t('footer.tagline')) ?></p>
            </div>
            <div>
                <h4><?= htmlspecialchars(t('footer.navigation')) ?></h4>
                <ul>
                    <li><a href="<?= lurl('/a-propos') ?>"><?= htmlspecialchars(t('nav.about')) ?></a></li>
                    <li><a href="<?= lurl('/poles-expertise') ?>"><?= htmlspecialchars(t('nav.services')) ?></a></li>
                    <li><a href="<?= lurl('/partenaires') ?>"><?= htmlspecialchars(t('footer.partners')) ?></a></li>
                    <li><a href="<?= lurl('/engagement-social') ?>"><?= htmlspecialchars(t('nav.careers')) ?></a></li>
                </ul>
            </div>
            <div>
                <h4><?= htmlspecialchars(t('footer.hq')) ?></h4>
                <ul>
                    <li><?= htmlspecialchars(t('footer.hq_address')) ?></li>
                    <li><?= htmlspecialchars(t('footer.tel')) ?> +237 620 22 48 11</li>
                    <li>Fax +237 6 98 58 55 06</li>
                    <li><a href="mailto:directeur.general@adetis-engineering.com">directeur.general@adetis-engineering.com</a></li>
                </ul>
            </div>
            <div>
                <h4><?= htmlspecialchars(t('footer.branch')) ?></h4>
                <ul>
                    <li>3 rue de Tourtille, 75020 Paris</li>
                    <li><?= htmlspecialchars(t('footer.tel')) ?> +33 6 17 92 12 19</li>
                    <li><a href="mailto:dtakendo@yahoo.fr">dtakendo@yahoo.fr</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; <?= date('Y') ?> ADETIS Engineering — <?= htmlspecialchars(t('footer.rights')) ?>
        </div>
    </div>
</footer>
