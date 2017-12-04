<?php
namespace dmstr\web;

use yii\base\Exception;
use yii\web\AssetBundle as BaseAdminLteAsset;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLtePluginAsset extends BaseAdminLteAsset
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components/fullcalendar/dist';
    public $css = [
        'fullcalendar.min.css',
    ];
    public $js = [
        'fullcalendar.min.js',
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
        'dmstr\web\AdminLteMomentAsset',
    ];


}
