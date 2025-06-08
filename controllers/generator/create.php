<?php Block::put('breadcrumb') ?>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= Backend::url('depcore/pdftoolkit/generator') ?>">Generator</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= e($this->pageTitle) ?></li>
    </ol>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <?= Form::open(['class' => 'd-flex flex-column h-100']) ?>

        <div class="flex-grow-1">
            <div class="d-flex h-100">
                <?= $this->formRender() ?>
                <div id="pdf-preview" class="d-none"></div>

            </div>
        </div>

        <div class="form-buttons">
            <div data-control="loader-container">
                <button
                    type="submit"
                    data-request="onGenerate"
                    class="btn btn-primary">
                    <?= __("Create") ?>
                </button>
                <button
                    type="submit"
                    data-request="onPreview"
                    data-request-success="$('#pdf-preview').replaceWith(data.newContent)"
                    class="btn btn-primary d-xl-inline d-none">
                    <?= __("Preview") ?>
                </button>
                <span class="btn-text">
                    <span class="button-separator"><?= __("or") ?></span>
                    <a
                        href="<?= Backend::url('depcore/pdftoolkit/generator') ?>"
                        class="btn btn-link p-0">
                        <?= __("Cancel") ?>
                    </a>
                </span>
            </div>
        </div>

    <?= Form::close() ?>

<?php else: ?>

    <p class="flash-message static error">
        <?= e($this->fatalError) ?>
    </p>
    <p>
        <a
            href="<?= Backend::url('depcore/pdftoolkit/generator') ?>"
            class="btn btn-default">
            <?= __("Return to List") ?>
        </a>
    </p>

<?php endif ?>
