<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Alarma */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="alarma-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'ID_ALARMA')->textInput() ?>

    <?php echo $form->field($model, 'NOMBRE')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'DESCRIPCION')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'LAT')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'LONG')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'ACTIVO')->textInput() ?>

    <?php echo $form->field($model, 'DIRECCION')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'TELEFONO_RESPONSABLE')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'NOMBRE_RESPONSABLE')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
