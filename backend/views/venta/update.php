<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Venta */

$this->title = 'Actualizar venta No. ' . ' ' . $model->numero_orden;
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->numero_orden, 'url' => ['view', 'id' => $model->numero_orden]];
$this->params['breadcrumbs'][] = 'Actualizar';
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-pencil fa-stack-1x"></i>
							   </span>';
?>
<div class="venta-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
