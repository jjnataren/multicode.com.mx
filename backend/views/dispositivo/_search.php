<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\DispositivoSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="dispositivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'ID_DISPOSITIVO') ?>

    <?php echo $form->field($model, 'CORREO_ELECTRONICO') ?>

    <?php echo $form->field($model, 'UID_FIREBASE') ?>

    <?php echo $form->field($model, 'ID_ALARMA') ?>

    <?php echo $form->field($model, 'TELEFONO') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
