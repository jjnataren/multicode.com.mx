<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\PromocionSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="promocion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id_promocion') ?>

    <?php echo $form->field($model, 'titulo') ?>

    <?php echo $form->field($model, 'descripcion') ?>

    <?php echo $form->field($model, 'fecha_inicio') ?>

    <?php echo $form->field($model, 'fecha_fin') ?>

    <?php // echo $form->field($model, 'estatus') ?>

    <?php // echo $form->field($model, 'imagen_url') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
