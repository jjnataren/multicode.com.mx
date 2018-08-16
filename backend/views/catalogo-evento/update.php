<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogoEvento */

$this->title = 'Update Catalogo Evento: ' . ' ' . $model->ID_EVENTO;
$this->params['breadcrumbs'][] = ['label' => 'Catalogo Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ID_EVENTO, 'url' => ['view', 'id' => $model->ID_EVENTO]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="catalogo-evento-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
