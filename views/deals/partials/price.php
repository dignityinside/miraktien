<?php

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $model app\models\deals\Deals */

$priceAfter = $model->getPrice(Html::encode($model->price_after), true);

echo $priceAfter ? '(' . $priceAfter . ')' : '';
