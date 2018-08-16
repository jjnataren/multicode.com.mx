<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TipoProducto */

$this->title = 'Actualizar tipo Producto: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id_tipo_producto]];
$this->params['breadcrumbs'][] = 'Actualizar';
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-pencil fa-stack-1x"></i>
							   </span>';
?>
<div class="tipo-producto-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
