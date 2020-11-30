<?php

use yii\helpers\Html;

/* @var $model app\models\post\Post */

?>

<div class="content_header">

    <?php if ($model->commentsAllowed()) : ?>
        <?php if ($model->commentsCount >= 1) : ?>
            <i class="fa fa-comments"></i> <?= Html::encode($model->commentsCount); ?>
        <?php endif; ?>
    <?php endif; ?>

</div>