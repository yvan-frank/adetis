<?php
/** @var array<string,string> $subjects */
/** @var array<string,mixed> $old */
/** @var array<string,string> $errors */
/** @var bool $sent */
?>
<section class="page-hero">
    <div class="container">
        <h1><?= te('contact.title') ?></h1>
        <p><?= te('contact.lead') ?></p>
    </div>
</section>

<section>
    <div class="container">
        <div class="grid grid-2">
            <div>
                <?php if ($sent): ?>
                    <div class="alert alert-success"><?= te('contact.sent') ?></div>
                <?php endif; ?>

                <form method="post" action="<?= htmlspecialchars(lurl('/contact')) ?>" novalidate>
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
                            <label for="phone"><?= te('contact.phone_optional') ?></label>
                            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars((string) ($old['phone'] ?? '')) ?>">
                        </div>
                        <div class="field">
                            <label for="subject"><?= te('contact.subject') ?></label>
                            <select id="subject" name="subject" required>
                                <option value=""><?= te('form.select') ?></option>
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
                            <button type="submit" class="btn btn-accent"><?= te('contact.submit') ?></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="grid" style="gap:24px">
                <?php require __DIR__ . '/partials/offices.php'; ?>
            </div>
        </div>
    </div>
</section>
