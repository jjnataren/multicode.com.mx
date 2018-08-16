<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/style.css',
    	'css/font-awesome.min.css',
    	'css/slicknav.css',
    	'css/responsive.css',
    	'css/animate.css',
    /*		'css/colors/red.css',
    		'css/colors/jade.css',
    		'css/colors/blue.css',
    		'css/colors/beige.css',
    		'css/colors/cyan.css',
    		'css/colors/green.css',
    		'css/colors/orange.css',
    		'css/colors/peach.css',
    		'css/colors/pink.css',
    		'css/colors/purple.css',
    		'css/colors/sky-blue.css',
			'css/colors/yellow.css',
    		'css/asset/css/bootstrap.min.css',
    	*/	
    		'css/jquery.dataTables.css',
    		'css/dataTables.bootstrap.css',
    ];

    public $js = ['js/jquery.dataTables.min.js',
    	'http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCALmBE3gqs03NEUOWeHz9jF-9OxdWqHCw',	
        'js/app.js'
    		//,'js/jquery-2.1.4.min.js'
    		,'js/jquery.migrate.js'
    		,'js/modernizrr.js'
    		,'js/asset/js/bootstrap.min.js'
    		,'js/jquery.fitvids.js'
    		,'js/owl.carousel.min.js'
    		,'js/nivo-lightbox.min.js'
    		,'js/jquery.isotope.min.js'
    		,'js/jquery.appear.js'
    		,'js/count-to.js'
    		,'js/jquery.textillate.js'
    		,'js/jquery.lettering.js'
    		,'js/jquery.easypiechart.min.js'
    		,'js/jquery.nicescroll.min.js'
    		,'js/jquery.parallax.js'
    		,'js/jquery.slicknav.js',
    		'js/script.js',
    		//'js/map.js',
    ];

    public $depends = [
      	  'yii\web\YiiAsset',
      	  'yii\bootstrap\BootstrapAsset',
      	  'common\assets\Html5shiv',
    ];
}
