<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CatalogoEventoSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="catalogo-evento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'ID_EVENTO') ?>

    <?php echo $form->field($model, 'NOMBRE') ?>

    <?php echo $form->field($model, 'DESCRIPCION') ?>

    <?php echo $form->field($model, 'ACTIVO') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
