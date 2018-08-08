<p align="center">
  <img src="https://raw.githubusercontent.com/luyadev/luya/master/docs/logo/luya-logo-0.2x.png" alt="LUYA Logo"/>
</p>

# LUYA Uikit 3 Kickstarter Application

[![LUYA](https://img.shields.io/badge/Powered%20by-LUYA-brightgreen.svg)](https://luya.io)
[![Total Downloads](https://poser.pugx.org/trk/luya-uikit-kickstarter/downloads)](https://packagist.org/packages/trk/luya-uikit-kickstarter)
[![License](https://poser.pugx.org/trk/luya-uikit-kickstarter/license)](https://packagist.org/packages/trk/luya-uikit-kickstarter)
[![Slack Support](https://img.shields.io/badge/Slack-luyadev-yellowgreen.svg)](https://slack.luya.io/)

## Installation

```sh
composer create-project trk/luya-kickstarter-uikit:dev-master
```

## Front-End

### Compiling

We have created our own NPM Package that includes our gulp workflow.  
Everything is prepared inside the `resources/theme` folder.

## Backend

### Assets

To speed up your local development you can uncomment the following lines in `configs/local.php` in order to use symlinking your assets instead of copy them every run.

```php
'assetManager' => [
    'class' => 'luya\web\AssetManager',
    'linkAssets' => true,
],
```

Now all assets will be symlinked and not copied.

> This will also enable CSS instant reload provided by `browserSync` (gulp).