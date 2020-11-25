<?php

use app\components\UserPermissions;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (UserPermissions::canAdminUsers()) : ?>
        <?= $form->field($model, 'status')->dropDownList(\app\models\User::getStatuses()) ?>
        <?= $form->field($model, 'premium')->dropDownList([0 => 'Нет', 1 => 'Да']) ?>
        <?= $form->field($model, 'payment_type')->dropDownList(\app\models\User::getPaymentTypes()) ?>
        <?= $form->field($model, 'payment_tariff')->dropDownList(\app\models\User::getTariff()) ?>
    <?php endif ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? 'Создать' : 'Сохранить профиль',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
