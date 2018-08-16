<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SolicitudRobo */

$this->title = 'Crear reporte de robo';
$this->params['breadcrumbs'][] = ['label' => 'Reportes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="solicitud-robo-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    		'dataprovider'=>$dataprovider,
    		'searchModel'=>$searchModel,
    		 
    ]) ?>

</div>
