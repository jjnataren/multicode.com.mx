<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Garantia */

$this->title = 'Crear nueva solicitud de garantia';
$this->params['breadcrumbs'][] = ['label' => 'Garantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-check-square fa-stack-1x"></i>
							   </span>';

?>
<div class="garantia-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    		'dataprovider'=>$dataprovider,
    		'searchModel'=>$searchModel,
    	
    ]) ?>

</div>
