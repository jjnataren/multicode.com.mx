<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SolicitudRobo */

$this->title = 'Actualizar reporte: ' . $model->id_solicitud_robo;
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_solicitud_robo, 'url' => ['view', 'id' => $model->id_solicitud_robo]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-user-secret fa-stack-1x"></i>
							   </span>';

?>
<div class="solicitud-robo-update">

    

    <?= $this->render('_form_update', [
        
    		'model' => $model,
    		//'dataprovider'=>$dataprovider,
    		//'searchModel'=>$searchModel,
    ]) ?>

</div>
