<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TipoProducto */

$this->title = 'Crear tipo de Producto';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-plus fa-stack-1x"></i>
							   </span>';
?>
<div class="tipo-producto-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
