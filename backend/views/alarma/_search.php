<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\AlarmaSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="alarma-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'ID_ALARMA') ?>

    <?php echo $form->field($model, 'NOMBRE') ?>

    <?php echo $form->field($model, 'DESCRIPCION') ?>

    <?php echo $form->field($model, 'LAT') ?>

    <?php echo $form->field($model, 'LONG') ?>

    <?php // echo $form->field($model, 'ACTIVO') ?>

    <?php // echo $form->field($model, 'DIRECCION') ?>

    <?php // echo $form->field($model, 'TELEFONO_RESPONSABLE') ?>

    <?php // echo $form->field($model, 'NOMBRE_RESPONSABLE') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
