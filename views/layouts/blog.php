<?php

/** @var array $donate */
$donate = \Yii::$app->params['donate'];

?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<div class="row">
    <div class="col-md-9">
        <?= $content; ?>
    </div>
    <div class="col-md-3">
        <div class="widget">
            <div class="widget-title">
                Соц-сети
            </div>
            <div class="widget-content">
                <div class="widget-content__social-icons">
                    <?php
                        $social = \Yii::$app->params['social'];
                    ?>
                    <p>
                        <a href="https://instagram.com/<?= $social['instagram'] ?>" target="_blank" rel="nofollow" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <span>
                            <a href="https://instagram.com/<?= $social['instagram'] ?>" target="_blank" rel="nofollow" title="Instagram">
                                Instagram
                            </a>
                        </span>
                    </p>
                    <p>
                        <a href="https://t.me/<?= $social['telegram'] ?>" target="_blank" rel="nofollow" title="Telegram канал"><i class="fa fa-telegram"></i></a>
                        <span>
                            <a href="https://t.me/<?= $social['telegram'] ?>" target="_blank" rel="nofollow" title="Telegram канал">
                                Telegram
                            </a>
                        </span>
                    </p>
                    <p>
                        <a href="https://mastodon.social/@<?= $social['mastodon'] ?>" target="_blank" rel="nofollow" title="Mastodon">
                            <i class="fab fa-mastodon"></i>
                        </a>
                        <span>
                            <a href="https://mastodon.social/@<?= $social['mastodon'] ?>" target="_blank" rel="nofollow" title="Mastodon">
                                Mastodon
                            </a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
        <div class="widget">
            <div class="widget-title">
                Donate
            </div>
            <div class="widget-content">
                <p>Яндекс.Деньги:<br />
                    <a href="https://money.yandex.ru/to/<?= $donate['yandexMoney']; ?>?lang=ru" target="_blank">
                        <?= $donate['yandexMoney']; ?>
                    </a>
                </p>
                <p>PayPal:<br />
                    <a href="https://www.paypal.me/<?= $donate['paypal'] ?>" target="_blank"><?= $donate['paypal'] ?></a>
                </p>
            </div>
        </div>
        <div class="widget">
            <div class="widget-title">
                Рекомендую
            </div>
            <div class="widget-content">
                <p>
                    <a href="https://svoimxodom.com" target="_blank">
                        <img src="https://svoimxodom.com/images/logo.png" width="220" alt="">
                    </a>
                </p>
            </div>
        </div>
        <div class="widget">
            <div class="widget-title">
                Друзья
            </div>
            <div class="widget-content">
                <ul>
                    <li><?= \yii\helpers\Html::a('Своим Ходом', 'http://svoimxodom.ru', ['target' => 'blank', 'rel' => 'nofollow'])?></li>
                    <li><?= \yii\helpers\Html::a('RMCreative', 'https://rmcreative.ru', ['target' => 'blank', 'rel' => 'nofollow'])?></li>
                    <li><?= \yii\helpers\Html::a('SEO блог Михаила Шакина', 'http://shakin.ru', ['target' => 'blank', 'rel' => 'nofollow'])?></li>
                    <li><?= \yii\helpers\Html::a('Лайфхакер', 'https://lifehacker.ru', ['target' => 'blank', 'rel' => 'nofollow'])?></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php $this->endContent(); ?>
