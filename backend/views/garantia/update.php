<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Garantia */

$this->title = 'Actualizar solicitud de garantia: ' . ' ' . $model->id_solicitud;
$this->params['breadcrumbs'][] = ['label' => 'Garantias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_solicitud, 'url' => ['view', 'id' => $model->id_solicitud]];
$this->params['breadcrumbs'][] = 'Actualizar solicitud de garantia';

$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-check-square fa-stack-1x"></i>
							   </span>';
?>
<div class="garantia-update">

    <?php echo $this->render('_form_update', [
         'model' => $model,
    		'dataprovider'=>$dataprovider,
    		'searchModel'=>$searchModel,
    ]) ?>

</div>
