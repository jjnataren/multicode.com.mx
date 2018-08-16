<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ProveedorSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="proveedor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'clave_proveedor') ?>

    <?php echo $form->field($model, 'nombre') ?>

    <?php echo $form->field($model, 'telefono') ?>

    <?php echo $form->field($model, 'direccion') ?>

    <?php echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'whatsapp') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
