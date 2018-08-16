<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Dispositivo */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="dispositivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'CORREO_ELECTRONICO')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'UID_FIREBASE')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'ID_ALARMA')->textInput() ?>

    <?php echo $form->field($model, 'TELEFONO')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
