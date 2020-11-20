<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="row">
    <div class="col-md-9">
        <?= $content; ?>
    </div>
    <div class="col-md-3">
        <?= $this->render('./partials/sidebar/subscribe.php'); ?>
        <?= $this->render('./partials/sidebar/social.php'); ?>
    </div>
</div>

<?php $this->endContent(); ?>
