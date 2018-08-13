<?php

namespace app\assets;

/**
 * Application Asset File.
 */
class ResourcesAsset extends \luya\web\Asset
{
    public $sourcePath = '@app/resources';
    
    public $css = [
        'dist/css/default.min.css'
    ];

    public $js = [
        'dist/js/uikit.min.js',
        'dist/js/uikit-icons.min.js',
        'dist/js/theme.min.js',
    ];
    
    public $publishOptions = [
        'only' => [
            'dist/css/*',
            'dist/js/*',
            'dist/images/*',
            'dist/fonts/*'
        ]
    ];

    public $depends = [
        'trk\theme\assets\Main'
    ];
}
