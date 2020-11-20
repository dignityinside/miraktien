<div class="widget">
    <div class="widget-title">
        <?= \Yii::t('app/blog', 'social_networking'); ?>
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
        </div>
    </div>
</div>
