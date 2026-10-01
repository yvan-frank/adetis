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
        <a href="<?= htmlspecialchars(lurl('/')) ?>"><?= te('nav.home') ?></a>
        <span>/</span>
        <a href="<?= htmlspecialchars(lurl('/poles-expertise')) ?>"><?= te('nav.services') ?></a>
        <span>/</span>
        <a href="<?= htmlspecialchars(lurl('/poles-expertise/immigration-etudes-france')) ?>"><?= te('pole.immigration_name') ?></a>
        <span>/</span>
        <span class="is-current"><?= te('immigration.breadcrumb') ?></span>
    </div>
</div>

<section class="page-hero">
    <div class="container">
        <h1><?= te('immigration.title') ?></h1>
        <p><?= te('immigration.lead') ?></p>
    </div>
</section>

<section>
    <div class="container" style="max-width: 820px">
        <?php if ($sent): ?>
            <div class="alert alert-success"><?= te('immigration.sent') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= htmlspecialchars(lurl('/poles-expertise/immigration-etudes-france/candidature')) ?>" novalidate>
            <div class="form-section">
                <h3 class="form-section__title"><?= te('immigration.section.contact') ?></h3>
                <div class="form-grid">
                    <div class="field">
                        <label for="name"><?= te('form.full_name') ?></label>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars((string) ($old['name'] ?? '')) ?>" required>
                        <?php if (!empty($errors['name'])): ?><p class="field-error"><?= htmlspecialchars($errors['name']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars((string) ($old['email'] ?? '')) ?>" required>
                        <?php if (!empty($errors['email'])): ?><p class="field-error"><?= htmlspecialchars($errors['email']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="phone"><?= te('immigration.phone') ?></label>
                        <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars((string) ($old['phone'] ?? '')) ?>" required>
                        <?php if (!empty($errors['phone'])): ?><p class="field-error"><?= htmlspecialchars($errors['phone']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="country"><?= te('immigration.country') ?></label>
                        <input type="text" id="country" name="country" value="<?= htmlspecialchars((string) ($old['country'] ?? '')) ?>" required>
                        <?php if (!empty($errors['country'])): ?><p class="field-error"><?= htmlspecialchars($errors['country']) ?></p><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section__title"><?= te('immigration.section.profile') ?></h3>
                <div class="form-grid">
                    <div class="field">
                        <label for="current_level"><?= te('immigration.current_level') ?></label>
                        <select id="current_level" name="current_level" required>
                            <option value=""><?= te('form.select') ?></option>
                            <?php foreach ($currentLevels as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['current_level'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['current_level'])): ?><p class="field-error"><?= htmlspecialchars($errors['current_level']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="current_field"><?= te('immigration.current_field') ?></label>
                        <input type="text" id="current_field" name="current_field" placeholder="<?= te('immigration.current_field.placeholder') ?>" value="<?= htmlspecialchars((string) ($old['current_field'] ?? '')) ?>" required>
                        <?php if (!empty($errors['current_field'])): ?><p class="field-error"><?= htmlspecialchars($errors['current_field']) ?></p><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section__title"><?= te('immigration.section.project') ?></h3>
                <div class="form-grid">
                    <div class="field">
                        <label for="target_level"><?= te('immigration.target_level') ?></label>
                        <select id="target_level" name="target_level" required>
                            <option value=""><?= te('form.select') ?></option>
                            <?php foreach ($targetLevels as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['target_level'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['target_level'])): ?><p class="field-error"><?= htmlspecialchars($errors['target_level']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="target_field"><?= te('immigration.target_field') ?></label>
                        <input type="text" id="target_field" name="target_field" placeholder="<?= te('immigration.target_field.placeholder') ?>" value="<?= htmlspecialchars((string) ($old['target_field'] ?? '')) ?>" required>
                        <?php if (!empty($errors['target_field'])): ?><p class="field-error"><?= htmlspecialchars($errors['target_field']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="intake"><?= te('immigration.intake') ?></label>
                        <select id="intake" name="intake" required>
                            <option value=""><?= te('form.select') ?></option>
                            <?php foreach ($intakes as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['intake'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['intake'])): ?><p class="field-error"><?= htmlspecialchars($errors['intake']) ?></p><?php endif; ?>
                    </div>
                    <div class="field">
                        <label for="language_level"><?= te('immigration.language_level') ?></label>
                        <input type="text" id="language_level" name="language_level" placeholder="<?= te('immigration.language_level.placeholder') ?>" value="<?= htmlspecialchars((string) ($old['language_level'] ?? '')) ?>">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section__title"><?= te('immigration.section.stage') ?></h3>
                <div class="form-grid">
                    <div class="field field-full">
                        <label for="stage"><?= te('immigration.stage') ?></label>
                        <select id="stage" name="stage" required>
                            <option value=""><?= te('form.select') ?></option>
                            <?php foreach ($stages as $key => $label): ?>
                                <option value="<?= htmlspecialchars($key) ?>"<?= (string) ($old['stage'] ?? '') === $key ? ' selected' : '' ?>><?= htmlspecialchars($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (!empty($errors['stage'])): ?><p class="field-error"><?= htmlspecialchars($errors['stage']) ?></p><?php endif; ?>
                    </div>
                    <div class="field field-full">
                        <label for="message"><?= te('immigration.message') ?></label>
                        <textarea id="message" name="message" rows="5" required><?= htmlspecialchars((string) ($old['message'] ?? '')) ?></textarea>
                        <?php if (!empty($errors['message'])): ?><p class="field-error"><?= htmlspecialchars($errors['message']) ?></p><?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="field-checkbox">
                <input type="checkbox" id="consent" name="consent" value="1"<?= !empty($old['consent']) ? ' checked' : '' ?> required>
                <label for="consent"><?= te('immigration.consent') ?></label>
            </div>
            <?php if (!empty($errors['consent'])): ?><p class="field-error"><?= htmlspecialchars($errors['consent']) ?></p><?php endif; ?>

            <div class="form-actions">
                <button type="submit" class="btn btn-accent"><?= te('immigration.submit') ?></button>
            </div>
        </form>
    </div>
</section>
