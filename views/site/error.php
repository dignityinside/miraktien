<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Ошибка 404 - Нет такой страницы';
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'robots', 'content' => 'noindex']);
?>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Если вы считаете, что страницы нет по нашей вине, <a href="/contact">напишите нам</a>.</p>
</div>
