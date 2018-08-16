<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Promocion */

$this->title = 'Actualizar promoción: ' . ' ' . $model->id_promocion;
$this->params['breadcrumbs'][] = ['label' => 'Promocions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_promocion, 'url' => ['view', 'id' => $model->id_promocion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promocion-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
