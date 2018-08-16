<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogoEvento */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="catalogo-evento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'NOMBRE')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'DESCRIPCION')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'ACTIVO')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
