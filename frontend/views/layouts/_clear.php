<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><html lang="en" class="no-js"> <![endif]-->
<html lang="<?= Yii::$app->language ?>">

<head>

  <!-- Basic -->
 <title><?= Html::encode($this->title) ?></title>

  <!-- Define Charset -->
   <meta charset="<?php echo Yii::$app->charset ?>"/>

  <!-- Responsive Metatag -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Page Description and Author -->
<?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
  <!-- Bootstrap CSS  -->


  <!-- Color CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="/css/colors/red.css" title="red" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/jade.css" title="jade" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/blue.css" title="blue" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/beige.css" title="beige" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/cyan.css" title="cyan" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/green.css" title="green" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/orange.css" title="orange" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/peach.css" title="peach" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/pink.css" title="pink" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/purple.css" title="purple" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/sky-blue.css" title="sky-blue" media="screen" />
  <link rel="stylesheet" type="text/css" href="/css/colors/yellow.css" title="yellow" media="screen" />

  <!-- Margo JS  -->
  <!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->



</head>

<body>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
