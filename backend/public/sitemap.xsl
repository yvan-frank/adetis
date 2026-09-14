<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:sm="http://www.sitemaps.org/schemas/sitemap/0.9">
<xsl:output method="html" encoding="UTF-8" indent="yes"/>

<xsl:template match="/">
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Sitemap — ADETIS Engineering</title>
    <link rel="icon" type="image/png" href="/assets/img/logo-adetis.png"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&amp;display=swap"/>
    <style>
        :root {
            --color-navy: #0b2e5c;
            --color-navy-dark: #071c3a;
            --color-navy-light: #1a4a8a;
            --color-red: #e0192c;
            --color-red-dark: #ad0f1f;
            --color-white: #ffffff;
            --color-gray-50: #f5f7fa;
            --color-gray-100: #eceff3;
            --color-gray-300: #ccd3dc;
            --color-gray-500: #6b7688;
            --color-gray-700: #3a4453;
            --color-ink: #1c2530;
            --radius: 10px;
            --shadow: 0 4px 20px rgba(11, 46, 92, 0.08);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Montserrat", "Segoe UI", Calibri, Arial, sans-serif;
            color: var(--color-ink);
            background: var(--color-gray-50);
            line-height: 1.6;
        }
        header {
            background: linear-gradient(135deg, var(--color-navy-dark), var(--color-navy) 60%, var(--color-navy-light));
            color: var(--color-white);
            padding: 40px 24px;
        }
        .header-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 18px;
        }
        header img { height: 52px; width: auto; }
        header h1 { margin: 0; font-size: 1.6rem; }
        header p { margin: 4px 0 0; color: #dbe6f7; font-size: 0.95rem; }
        .wrap { max-width: 1100px; margin: -28px auto 60px; padding: 0 24px; }
        .summary {
            background: var(--color-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px 28px;
            margin-bottom: 24px;
            display: flex;
            flex-wrap: wrap;
            gap: 28px;
            align-items: center;
            font-size: 0.92rem;
            color: var(--color-gray-700);
        }
        .summary strong { color: var(--color-navy-dark); font-size: 1.2rem; display: block; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--color-white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        thead th {
            text-align: left;
            background: var(--color-navy-dark);
            color: var(--color-white);
            padding: 14px 18px;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        tbody tr { border-top: 1px solid var(--color-gray-100); }
        tbody tr:hover { background: var(--color-gray-50); }
        tbody td { padding: 14px 18px; font-size: 0.92rem; vertical-align: middle; }
        tbody td a { color: var(--color-navy); text-decoration: none; font-weight: 500; word-break: break-all; }
        tbody td a:hover { color: var(--color-red); }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            background: var(--color-gray-100);
            color: var(--color-navy-dark);
            font-size: 0.78rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .prio-bar {
            display: inline-block;
            width: 60px;
            height: 6px;
            border-radius: 999px;
            background: var(--color-gray-100);
            overflow: hidden;
            vertical-align: middle;
            margin-right: 8px;
        }
        .prio-bar span {
            display: block;
            height: 100%;
            background: var(--color-red);
        }
        .prio-cell { white-space: nowrap; }
        .muted { color: var(--color-gray-500); font-size: 0.85rem; }
        footer {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 24px 40px;
            color: var(--color-gray-500);
            font-size: 0.82rem;
        }
        footer a { color: var(--color-navy); }
        @media (max-width: 640px) {
            thead { display: none; }
            table, tbody, tr, td { display: block; width: 100%; }
            tbody tr { padding: 14px 18px; }
            tbody td { padding: 4px 0; border: none; }
            tbody td.prio-cell { order: 3; }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-inner">
            <img src="/assets/img/logo-adetis.png" alt="ADETIS Engineering"/>
            <div>
                <h1>Sitemap — ADETIS Engineering</h1>
                <p>Index des pages du site, généré automatiquement pour les moteurs de recherche.</p>
            </div>
        </div>
    </header>

    <div class="wrap">
        <div class="summary">
            <div>
                <strong><xsl:value-of select="count(sm:urlset/sm:url)"/></strong>
                <span class="muted">pages indexées</span>
            </div>
            <div class="muted">
                Ce fichier suit le standard
                <a href="https://www.sitemaps.org/protocol.html" style="color:var(--color-navy)">sitemaps.org</a>
                — les robots (Googlebot, Bingbot…) le lisent directement en XML ; cette mise en page n'apparaît qu'aux visiteurs humains.
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>URL</th>
                    <th>Priorité</th>
                    <th>Fréquence</th>
                    <th>Dernière révision</th>
                </tr>
            </thead>
            <tbody>
                <xsl:for-each select="sm:urlset/sm:url">
                <xsl:sort select="sm:priority" order="descending"/>
                <tr>
                    <td>
                        <a href="{sm:loc}"><xsl:value-of select="sm:loc"/></a>
                    </td>
                    <td class="prio-cell">
                        <span class="prio-bar"><span style="width:{sm:priority * 100}%"></span></span>
                        <xsl:value-of select="sm:priority"/>
                    </td>
                    <td><span class="badge"><xsl:value-of select="sm:changefreq"/></span></td>
                    <td class="muted"><xsl:value-of select="sm:lastmod"/></td>
                </tr>
                </xsl:for-each>
            </tbody>
        </table>
    </div>

    <footer>
        Généré par <a href="/">adetis-engineering.com</a> — voir aussi le <a href="/robots.txt">robots.txt</a>.
    </footer>
</body>
</html>
</xsl:template>
</xsl:stylesheet>
