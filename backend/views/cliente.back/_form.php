<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'estado')->textInput() ?>

    <?php echo $form->field($model, 'codigo_postal')->textInput() ?>

    <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'telefono')->textInput() ?>

    <?php echo $form->field($model, 'whatsapp')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'fecha_registro')->textInput() ?>

    <?php echo $form->field($model, 'delegacion_mpio')->textInput() ?>

    <?php echo $form->field($model, 'rfc')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'id_usuario')->textInput() ?>

    <?php echo $form->field($model, 'fecha_nacimiento')->textInput() ?>

    <?php echo $form->field($model, 'apellido_materno')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'apellido_paterno')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
