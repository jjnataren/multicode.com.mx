<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Promocion */

$this->title = 'Crear promoción';
$this->params['breadcrumbs'][] = ['label' => 'Promociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promocion-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
