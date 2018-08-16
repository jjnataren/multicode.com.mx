<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CodigoLogSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="codigo-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'numero_serie') ?>

    <?php echo $form->field($model, 'cliente') ?>

    <?php echo $form->field($model, 'fecha') ?>

    <?php echo $form->field($model, 'dispositivo') ?>

    <?php // echo $form->field($model, 'activacion') ?>

    <?php // echo $form->field($model, 'codigo_respuesta') ?>

    <?php // echo $form->field($model, 'reactivacion') ?>

    <?php // echo $form->field($model, 'sistema_operativo') ?>

    <?php // echo $form->field($model, 'token_generado') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
