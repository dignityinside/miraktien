<?php

use app\components\UserPermissions;
use app\helpers\Text;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Markdown;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\post\Post */

$this->title = Html::encode($model->title);

$this->params['breadcrumbs'][] = ['label' => 'Блог', 'url' => ['/post/index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'title', 'content' => $model->title]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->meta_description]);
$this->registerMetaTag(['name' => 'robots', 'content' => 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1']);

$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::to(['post/view', 'slug' => $model->slug], true)]);
?>
<div class="post-view">

    <h1><?= $this->title; ?></h1>

    <?php if (UserPermissions::canAdminPost()) : ?>
        <p><i class="fa fa-edit"></i>
            <?= Html::a('Изменить', ['post/update', 'id' => $model->id]); ?></p>
    <?php endif; ?>

    <?php if ($model->isPremium()) : ?>
        <?= Text::hidecut('[cut]',
            Text::hideCut('[premium]', HtmlPurifier::process(Markdown::process($model->content, 'gfm')))
        ); ?>
    <?php else : ?>
        <?= Text::hidecut('[cut]',
            Text::cut('[premium]', HtmlPurifier::process(Markdown::process($model->content, 'gfm')))
        ); ?>
        <?php if ($model->ontop) : ?>
            <?= $this->render('../partials/premium', ['premium' => $model->premium]); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($model->show_share_buttons) : ?>
        <?= $this->render('/partials/share'); ?>
    <?php endif; ?>

    <?php if ($model->show_post_details) : ?>
        <?= $this->render('_post_footer', ['model' => $model]); ?>
    <?php endif; ?>

    <?php if ($model->commentsAllowed()) : ?>
        <?= $this->render('_comments', ['model' => $model]); ?>
    <?php endif; ?>

</div>
