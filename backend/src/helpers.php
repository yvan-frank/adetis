<?php

use App\Core\Lang;

/** Texte traduit dans la langue courante (voir App\Core\Lang). */
function t(string $key, array $replace = []): string
{
    return Lang::t($key, $replace);
}

/** URL interne localisée : lurl('/contact') -> '/en/contact' en anglais. */
function lurl(string $path): string
{
    return Lang::url($path);
}

/** t() échappé pour l'HTML. */
function te(string $key, array $replace = []): string
{
    return htmlspecialchars(Lang::t($key, $replace));
}
