<?php

use luya\cms\helpers\Url;

/* @var $this \luya\web\View; */

?>
<div class="uk-section uk-section-default" data-uk-height-viewport="expand: true">
    <div class="uk-container">
        <!-- DELETE ME -->
        <div class="uk-margin" data-<div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-alert uk-alert-success uk-text-center">
                    <?= Yii::t('app', '<h3 class="uk-heading-primary uk-heading-divider">You are ready!</h3>'); ?>
                    <p>Yes, you have successfully installed <span class="uk-text-danger">LUYA</span> on your System. You are now able to login to the administration area to create your pages.</p>
                    <?= Yii::t('app', '<p><a href="{link}" class="uk-button uk-button-primary uk-button-large">Open administration area</a></p>', ['link' => Url::toInternal(['admin/default/index']), true]); ?>
                </div>
            </div>
        </div>
        <!-- DELETE ME -->
        <div class="uk-margin" data-<div class="uk-grid">
            <?php if (count(Yii::$app->menu->getLevelContainer(2)) > 0): ?>
                <div class="uk-width-2-6@m">
                    <ul class="nav nav-pills nav-stacked">
                        <?php foreach (Yii::$app->menu->getLevelContainer(2) as $child): /* @var $child \luya\cms\menu\Item */ ?>
                            <li <?php if ($child->isActive): ?>class="active" <?php endif; ?>><a href="<?= $child->link; ?>"><?= $child->title; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="uk-width-4-6@m">
                    <?= $content; ?>
                </div>
            <?php else: ?>
                <div class="uk-width-1-1">
                    <?= $content; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
