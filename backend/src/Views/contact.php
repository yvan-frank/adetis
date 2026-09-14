<?php
/** @var array<string,string> $subjects */
/** @var array<string,mixed> $old */
/** @var array<string,string> $errors */
/** @var bool $sent */
?>
<section class="page-hero">
    <div class="container">
        <h1>Contactez-nous</h1>
        <p>Une question sur nos études CAO, un projet d'achat de machines, une demande de formation ou de partenariat : écrivez-nous.</p>
    </div>
</section>

<section>
    <div class="container">
        <div class="grid grid-2">
            <div>
                <?php if ($sent): ?>
                    <div class="alert alert-success">Votre message a bien été envoyé. Notre équipe reviendra vers vous rapidement.</div>
                <?php endif; ?>

                <form method="post" action="/contact" novalidate>
                    <div class="form-grid">
                        <div class="field">
                            <label for="name">Nom complet</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars((string) ($old['name'] ?? '')) ?>" required>
                            <?php if (!empty($errors['name'])): ?><p class="field-error"><?= htmlspecialchars($errors['name']) ?></p><?php endif; ?>
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars((string) ($old['email'] ?? '')) ?>" required>
                            <?php if (!empty($errors['email'])): ?><p class="field-error"><?= htmlspecialchars($errors['email']) ?></p><?php endif; ?>
                        </div>
                        <div class="field">
                            <label for="phone">Téléphone (optionnel)</label>
                            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars((string) ($old['phone'] ?? '')) ?>">
                        </div>
                        <div class="field">
                            <label for="subject">Objet de la demande</label>
                            <select id="subject" name="subject" required>
                                <option value="">— Sélectionner —</option>
                                <?php foreach ($subjects as $key => $label): ?>
                                    <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['subject'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['subject'])): ?><p class="field-error"><?= htmlspecialchars($errors['subject']) ?></p><?php endif; ?>
                        </div>
                        <div class="field field-full">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="6" required><?= htmlspecialchars((string) ($old['message'] ?? '')) ?></textarea>
                            <?php if (!empty($errors['message'])): ?><p class="field-error"><?= htmlspecialchars($errors['message']) ?></p><?php endif; ?>
                        </div>
                        <div class="field field-full">
                            <button type="submit" class="btn btn-solid">Envoyer le message</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="grid" style="gap:24px">
                <div class="office-card">
                    <h3>Siège social — Douala, Cameroun</h3>
                    <dl>
                        <dt>Adresse</dt>
                        <dd>BP 12067, Douala — Cameroun</dd>
                        <dt>Téléphone</dt>
                        <dd>+237 620 22 48 11</dd>
                        <dt>Fax</dt>
                        <dd>+237 6 98 58 55 06</dd>
                        <dt>Email</dt>
                        <dd><a href="mailto:directeur.general@adetis-engineering.com">directeur.general@adetis-engineering.com</a></dd>
                    </dl>
                </div>
                <div class="office-card">
                    <h3>Filiale — Paris, France</h3>
                    <dl>
                        <dt>Adresse</dt>
                        <dd>3 rue de Tourtille, 75020 Paris</dd>
                        <dt>Téléphone</dt>
                        <dd>+33 6 17 92 12 19</dd>
                        <dt>Email</dt>
                        <dd><a href="mailto:dtakendo@yahoo.fr">dtakendo@yahoo.fr</a></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>
