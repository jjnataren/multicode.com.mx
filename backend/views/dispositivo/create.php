<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Dispositivo */

$this->title = 'Create Dispositivo';
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispositivo-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
