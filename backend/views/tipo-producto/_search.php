<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\TiempoProductoSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="tipo-producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id_tipo_producto') ?>

    <?php echo $form->field($model, 'nombre') ?>

    <?php echo $form->field($model, 'descripcion') ?>

    <?php echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
