<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CodigoLog */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="codigo-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'numero_serie')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'cliente')->textInput() ?>

    <?php echo $form->field($model, 'fecha')->textInput() ?>

    <?php echo $form->field($model, 'dispositivo')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'activacion')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'codigo_respuesta')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'reactivacion')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'sistema_operativo')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'token_generado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
