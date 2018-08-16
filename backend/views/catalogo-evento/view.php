<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CatalogoEvento */

$this->title = $model->ID_EVENTO;
$this->params['breadcrumbs'][] = ['label' => 'Catalogo Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalogo-evento-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->ID_EVENTO], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->ID_EVENTO], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID_EVENTO',
            'NOMBRE',
            'DESCRIPCION',
            'ACTIVO',
        ],
    ]) ?>

</div>
