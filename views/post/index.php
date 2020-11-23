<?php

use yii\helpers\Html;
use \yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\post\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \Yii::$app->params['site']['name'];

$this->registerMetaTag(
    [
        'name'    => 'description',
        'content' => '',
    ]
);

?>
<div class="post-index">

    <div class="post-header text-center">
        <h1><i class="fas fa-feather"></i> <?=\Yii::$app->params['site']['name'];?></h1>
    </div>

    <?php if ($dataProvider->getTotalCount() >= \Yii::$app->params['post']['pageSize']) : ?>

        <ul class="post-filter">
            <li><?= Html::a('<i class="fa fa-clock"></i>Новые', '/post/index') ?></li>
            <li><?= Html::a('<i class="fa fa-eye"></i>Популярные', '/post/index/1') ?></li>
            <li><?= Html::a('<i class="fa fa-comments"></i>Обсуждаемые', '/post/index/2') ?></li>
        </ul>

    <?php endif; ?>

    <?php Pjax::begin(); ?>
    <?= ListView::widget(
        [
            'dataProvider' => $dataProvider,
            'emptyText'    => 'Статьи не найдены.',
            'itemView'     => '_view',
            'layout' => "{items}{pager}",
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
