<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Alarma */

$this->title = 'Create Alarma';
$this->params['breadcrumbs'][] = ['label' => 'Alarmas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alarma-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
