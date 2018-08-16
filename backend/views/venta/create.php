<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Venta */

$this->title = 'Crear orden de venta';
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-thumbs-o-up fa-stack-1x"></i>
							   </span>';

?>
<div class="venta-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    	'dataprovider'=>$dataprovider,
    		'searchModel'=>$searchModel,
    		'productos'=>$productos
    ]) ?>

</div>
