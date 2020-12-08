<?php

use yii\helpers\Html;
use app\models\User;

/** @var bool $premium */

?>
<div class="premium">
    <?php if ($premium) : ?>
        <p class="premium__header">Продолжение доступно только для премиум-пользователя</p>
        <p>Оформи премиум прямо сейчас<br> и открой доступ к этому и другим эксклюзивным материалам</p>
    <?php else : ?>
        <p class="premium__header">Понравился обзор компании? Хочешь получать каждые 10 дней новый?</p>
        <p>Тогда прямо сейчас получи премиум-доступ. Ты станешь топ-информированным и успешным инвестором, сможешь самостоятельно составить сбалансированный портфель ценных бумаг.</p>
    <?php endif; ?>

    <div class="premium__price">
        <div class="premium_price__month">
            <span class="premium_price__length">1 Месяц</span>
            <span class="premium_price__value">
                <?= User::getPremiumPriceByTariff(User::TARIFF_MONTH) ?>
            </span>
        </div>
        <div class="premium_price__year">
            <span class="premium_price__length">12 Месяцев</span>
            <span class="premium_price__value">
                <s><?= Yii::$app->formatter->asCurrency(\Yii::$app->params['premium']['price'] * 12); ?></s>
            </span>
            <span style="color: #d43f3a">
                <?= User::getPremiumPriceByTariff(User::TARIFF_YEAR) ?>
                (<?php

                $month = \Yii::$app->params['premium']['freeMonth'];

                echo $month;

                if ($month === 1) {
                    echo " Месяц";
                } else if ($month <= 4) {
                    echo " Месяца";
                } else {
                    echo " Месяцев";
                }

                ?> в подарок)
            </span>
        </div>
    </div>
    <div class="premium_price__button_box">
        <?php if (\Yii::$app->user->identity !== null) : ?>
            <?php
                /** @var User $user */
                $user = User::findOne(\Yii::$app->user->identity->getId());
            ?>

            <?php if ($user->status !== User::STATUS_WAIT && $user->isExpired($user->premium_until)) : ?>
                <p>Твоя премиум подписка закончилась!</p>
                <?php $buttonText = \Yii::t('app', 'button_refresh_get_premium'); ?>
            <?php else: ?>
                <p>Ты уже заказал(а) премиум, но ещё не оплатил(а)!</p>
                <?php $buttonText = \Yii::t('app', 'button_continue_get_premium'); ?>
            <?php endif; ?>

            <p><?= Html::a($buttonText, '/user/' . \Yii::$app->user->identity->getId(), ['class' => 'btn btn-danger btn-lg btn-block', 'style' => 'color: #fff;']) ?></p>

            <p>Если у тебя остались вопросы или нужна помощь, напиши мне на <?= \Yii::$app->params['adminEmail'] ?></p>
        <?php else : ?>
            <p><?= Html::a(\Yii::t('app', 'button_get_premium'), '/signup', ['class' => 'btn btn-danger btn-lg btn-block', 'style' => 'color: #fff;']) ?></p>
        <?php endif; ?>
    </div>
    <?php if (\Yii::$app->user->identity === null) : ?>
        <p><?= Html::a('Я уже премиум', '/login') ?> | <?= Html::a('Подробнее →', '/premium') ?></p>
    <?php endif; ?>
</div>
