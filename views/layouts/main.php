<?php

/**
 * @var $this luya\web\View
 * @var $content
 */

use trk\theme\Module as Theme;

// echo Theme::render();
// or

use app\assets\ResourcesAsset;

use trk\theme\widgets\Navigation;
use trk\theme\widgets\Languages;

use luya\cms\tags\PageTag;

// Set website url
Theme::setConfig('appUrl', $this->publicHtml ?: '/');
// Set current page
Theme::setConfig('page', Yii::$app->menu->current);
// Set current language
Theme::setConfig('language', Yii::$app->composition->language);
// Set website title
Theme::setConfig('title', $this->title);
// Set icons
Theme::setConfig('icons', 'favicon', Theme::getConfig('appUrl') . 'images/logo/0.2x/luya_logo@0.2x.png');
Theme::setConfig('icons', 'touch_icon', Theme::getConfig('appUrl') . 'images/logo/0.2x/luya_logo@0.2x.png');
// Set website logo image
Theme::setConfig('logo', 'image', Theme::getConfig('appUrl') . 'images/logo/0.2x/luya_logo@0.2x.png');
// Set website mobile-logo image and mobile logo settings
Theme::setConfig('mobile', 'logo', 'center');
Theme::setConfig('mobile', 'toggle', 'right');
Theme::setConfig('logo', 'image_mobile', Theme::getConfig('appUrl') . 'images/logo/0.2x/luya_logo@0.2x.png');

// Load parser
$parser = new PageTag();

// Header
$header = Yii::$app->menu->find()->where(['alias' => 'header'])->container('system')->with('hidden')->one();
Theme::sidebar('header', $header ? $parser->parse($header->navId, 'content') : "");
// Content
// Theme::sidebar('content', $parser->parse(Yii::$app->menu->current->navId, 'content'));
Theme::sidebar('content', $this->render('welcome', ['content' => $content]));
// Footer
$footer = Yii::$app->menu->find()->where(['alias' => 'footer'])->container('system')->with('hidden')->one();
Theme::sidebar('footer', $footer ? $parser->parse($footer->navId, 'content') : $this->render('footer'));
// Social
$social = Yii::$app->menu->find()->where(['alias' => 'social'])->container('system')->with('hidden')->one();
Theme::sidebar('social', $social ? $parser->parse($social->navId, 'content') : "");
// Set navigation data
$navigation = Navigation::toArray();
Theme::sidebar('navbar', Theme::render('templates/menu/menu', ['items' => array_merge($navigation, Languages::toArray()), 'position' => 'navbar']));
Theme::sidebar('mobile', Theme::render('templates/menu/menu', ['items' => $navigation, 'position' => 'offcanvas']));

ResourcesAsset::register($this);

Yii::$app->view->beginPage();

// $this->render('sidebar-positions');

echo Theme::render('header');

echo Theme::sidebar('content');

echo Theme::render('footer');

Yii::$app->view->endPage();