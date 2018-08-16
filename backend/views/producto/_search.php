<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ProductoSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="producto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'numero_serie') ?>

    <?php echo $form->field($model, 'tipo_producto') ?>

    <?php echo $form->field($model, 'fecha_fabricacion') ?>

    <?php echo $form->field($model, 'estado') ?>

    <?php echo $form->field($model, 'codigo_registro') ?>

    <?php // echo $form->field($model, 'precio_sugerido') ?>

    <?php // echo $form->field($model, 'descripcion') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
