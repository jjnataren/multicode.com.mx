<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\GarantiaSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="garantia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id_solicitud') ?>

    <?php echo $form->field($model, 'numero_serie') ?>

    <?php echo $form->field($model, 'fecha_solicitud') ?>

    <?php echo $form->field($model, 'fecha_ingreso_garantia') ?>

    <?php echo $form->field($model, 'fecha_valido_cliente') ?>

    <?php // echo $form->field($model, 'estatus') ?>

    <?php // echo $form->field($model, 'fecha_envio') ?>

    <?php // echo $form->field($model, 'folio_envio') ?>

    <?php // echo $form->field($model, 'numero_guia') ?>

    <?php // echo $form->field($model, 'comentarios') ?>

    <?php // echo $form->field($model, 'fecha_recibio_cliente') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
