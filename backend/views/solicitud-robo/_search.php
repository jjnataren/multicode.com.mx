<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\SolicitudRoboSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="solicitud-robo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_solicitud_robo') ?>

    <?= $form->field($model, 'numero_serie') ?>

    <?= $form->field($model, 'fecha_robo') ?>

    <?= $form->field($model, 'fecha_solicitud') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?php // echo $form->field($model, 'acta_robo') ?>

    <?php // echo $form->field($model, 'estatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
