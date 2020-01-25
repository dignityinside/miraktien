<?php

use yii\helpers\Html;
use \yii\widgets\ListView;
use yii\widgets\Pjax;
use app\assets\DealsAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Руланд скидки';

DealsAsset::register($this);

?>

<div class="deals-index">

    <div class="post-header text-center">
        <h1><i class="fas fa-handshake"></i> <?= $this->title ?></h1>
    </div>

    <ul class="deals-index-filter">
        <li><?= Html::a('<i class="fa fa-clock"></i>Новые', '/deals') ?></li>
        <li><?= Html::a('<i class="fa fa-eye"></i>Популярные', '/deals/hits') ?></li>
        <li><?= Html::a('<i class="fa fa-comments"></i>Обсуждаемые', '/deals/comments') ?></li>
        <li><?= Html::a('<i class="far fa-clock"></i>Скоро заканчиваются', '/deals/soon') ?></li>
        <li><?= Html::a('<i class="fas fa-flag-checkered"></i>Завершенные', '/deals/expired') ?></li>
    </ul>
    <div class="deals-index-list">
        <?php Pjax::begin(); ?>
            <?= ListView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'emptyText' => 'Скидки не найдены.',
                    'itemView' => '_view',
                    'layout' => "{items}{pager}",
                ]
            ); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
