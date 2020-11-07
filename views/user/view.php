<?php

use app\components\UserPermissions;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $authClients \yii\authclient\ClientInterface[] */

$this->title = $model->username;

?>
<div class="row user-view">
    <div class="col-xs-12">
        <div class="row">
            <div class="col-sm-8 clearfix">
                <div class="user-view-avatar">
                    <?= \app\widgets\Avatar::widget(
                        [
                            'user' => $model,
                            'size' => 165,
                        ]
                    ) ?>
                </div>

                <h1><?= Html::encode($this->title) ?></h1>

                <h3><?= Html::encode($model->premium ? 'Premium' : ''); ?></h3>

                <?php if (UserPermissions::canEditUser($model)) : ?>
                    <p>
                        <?= Html::a('Изменить профиль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    </p>
                <?php endif ?>
                <?php if (UserPermissions::canAdminUsers()) : ?>
                    <p>
                        <?= Html::a(
                            'Удалить',
                            ['delete', 'id' => $model->id],
                            [
                                'class' => 'btn btn-danger',
                                'data'  => [
                                    'confirm' => 'Вы уверены что хотите удалить свой аккаунт?',
                                    'method'  => 'post',
                                ],
                            ]
                        ) ?>
                    </p>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
