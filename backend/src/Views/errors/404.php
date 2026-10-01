<?php
$pageTitle = t('404.title') . ' — ADETIS Engineering';
$robots = 'noindex, follow';
$translated = true;
?>
<div style="text-align:center;padding:120px 20px">
    <h1>404</h1>
    <p><?= te('404.text') ?></p>
    <a href="<?= htmlspecialchars(lurl('/')) ?>"><?= te('404.back') ?></a>
</div>
