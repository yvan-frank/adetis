<?php
/** @var array<string,string> $currentLevels */
/** @var array<string,string> $targetLevels */
/** @var array<string,string> $intakes */
/** @var array<string,string> $stages */
/** @var array<string,mixed> $old */
/** @var array<string,string> $errors */
/** @var bool $sent */
?>

<div class="breadcrumb">
    <div class="container">
        <a href="/">Accueil</a>
        <span>/</span>
        <a href="/poles-expertise">Nos pôles d'expertise</a>
        <span>/</span>
        <a href="/poles-expertise/immigration-etudes-france">Immigration &amp; Études en France</a>
        <span>/</span>
        <span class="is-current">Candidater</span>
    </div>
</div>

<section class="page-hero">
    <div class="container">
        <h1>Candidater à un accompagnement Campus France</h1>
        <p>Parlez-nous de votre profil et de votre projet : un conseiller étudie votre situation et revient vers vous avec les étapes précises à suivre.</p>
    </div>
</section>

<section>
    <div class="container" style="max-width: 820px">
        <?php if ($sent): ?>
            <div class="alert alert-success">Votre candidature a bien été envoyée. Un conseiller ADETIS vous recontacte rapidement.</div>
        <?php endif; ?>

        <form method="post" action="/poles-expertise/immigration-etudes-france/candidature" novalidate>
            <div class="form-section">
                <h3 class="form-section__title">Vos coordonnées</h3>
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
                        <label for="phone">Téléphone / WhatsApp</label>
                        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars((string) ($old['phone'] ?? '')) ?>" required>
                        <?php if (!empty($errors['phone'])): ?><p class="field-error"><?= htmlspecialchars($errors['phone']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="country">Pays de résidence actuel</label>
                        <input type="text" id="country" name="country" value="<?= htmlspecialchars((string) ($old['country'] ?? '')) ?>" required>
                        <?php if (!empty($errors['country'])): ?><p class="field-error"><?= htmlspecialchars($errors['country']) ?></p><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section__title">Votre profil académique</h3>
                <div class="form-grid">
                    <div class="field">
                        <label for="current_level">Dernier diplôme / niveau actuel</label>
                        <select id="current_level" name="current_level" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($currentLevels as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['current_level'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['current_level'])): ?><p class="field-error"><?= htmlspecialchars($errors['current_level']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="current_field">Filière suivie</label>
                        <input type="text" id="current_field" name="current_field" placeholder="Ex. Génie civil" value="<?= htmlspecialchars((string) ($old['current_field'] ?? '')) ?>" required>
                        <?php if (!empty($errors['current_field'])): ?><p class="field-error"><?= htmlspecialchars($errors['current_field']) ?></p><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section__title">Votre projet d'études en France</h3>
                <div class="form-grid">
                    <div class="field">
                        <label for="target_level">Niveau visé en France</label>
                        <select id="target_level" name="target_level" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($targetLevels as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['target_level'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['target_level'])): ?><p class="field-error"><?= htmlspecialchars($errors['target_level']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="target_field">Domaine / filière souhaité</label>
                        <input type="text" id="target_field" name="target_field" placeholder="Ex. Master Génie civil" value="<?= htmlspecialchars((string) ($old['target_field'] ?? '')) ?>" required>
                        <?php if (!empty($errors['target_field'])): ?><p class="field-error"><?= htmlspecialchars($errors['target_field']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="intake">Rentrée visée</label>
                        <select id="intake" name="intake" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($intakes as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['intake'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['intake'])): ?><p class="field-error"><?= htmlspecialchars($errors['intake']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="language_level">Niveau de français ou d'anglais (optionnel)</label>
                        <input type="text" id="language_level" name="language_level" placeholder="Ex. B2" value="<?= htmlspecialchars((string) ($old['language_level'] ?? '')) ?>">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section__title">Où en êtes-vous ?</h3>
                <div class="form-grid">
                    <div class="field field-full">
                        <label for="stage">Étape actuelle de votre démarche</label>
                        <select id="stage" name="stage" required>
                            <option value="">— Sélectionner —</option>
                            <?php foreach ($stages as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['stage'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['stage'])): ?><p class="field-error"><?= htmlspecialchars($errors['stage']) ?></p><?php endif; ?>
                    </div>
                    <div class="field field-full">
                        <label for="message">Message — précisions sur votre situation</label>
                        <textarea id="message" name="message" rows="5" required><?= htmlspecialchars((string) ($old['message'] ?? '')) ?></textarea>
                        <?php if (!empty($errors['message'])): ?><p class="field-error"><?= htmlspecialchars($errors['message']) ?></p><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="field-checkbox">
                <input type="checkbox" id="consent" name="consent" value="1"<?= !empty($old['consent']) ? ' checked' : '' ?> required>
                <label for="consent">J'accepte qu'ADETIS Engineering traite mes données pour étudier ma demande d'accompagnement.</label>
            </div>
            <?php if (!empty($errors['consent'])): ?><p class="field-error"><?= htmlspecialchars($errors['consent']) ?></p><?php endif; ?>

            <div class="form-actions">
                <button type="submit" class="btn btn-accent">Envoyer ma candidature</button>
            </div>
        </form>
    </div>
</section>
