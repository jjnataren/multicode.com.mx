<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Proveedor */

$this->title = 'Crear proveedor';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-product-hunt fa-stack-1x"></i>
							   </span>';
?>
<div class="proveedor-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
