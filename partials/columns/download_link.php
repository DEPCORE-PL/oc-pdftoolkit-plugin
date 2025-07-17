<?php if ($record->downloadLink): ?>
    <a href="<?= Backend::url($record->downloadLink) ?>">
        <?= htmlspecialchars($record->downloadLink, ENT_QUOTES, 'UTF-8') ?>
    </a>
<?php else: ?>
    &mdash;
<?php endif; ?>
