<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CodigoLog */

$this->title = 'Create Codigo Log';
$this->params['breadcrumbs'][] = ['label' => 'Codigo Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="codigo-log-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
