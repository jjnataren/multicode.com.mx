<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = 'Actualizar Producto : ' . ' ' . $model->numero_serie;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->numero_serie, 'url' => ['view', 'id' => $model->numero_serie]];
$this->params['breadcrumbs'][] = 'actualizar';
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-pencil fa-stack-1x"></i>
							   </span>';
?>
<div class="producto-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
