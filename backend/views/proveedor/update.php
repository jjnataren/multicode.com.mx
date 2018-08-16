<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Proveedor */

$this->title = 'Update Proveedor: ' . ' ' . $model->clave_proveedor;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->clave_proveedor, 'url' => ['view', 'id' => $model->clave_proveedor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="proveedor-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
