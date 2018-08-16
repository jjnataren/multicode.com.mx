<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title = $model->id_cliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

    <p>
        <?php echo Html::a('Update', ['update', 'id' => $model->id_cliente], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Delete', ['delete', 'id' => $model->id_cliente], [
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
            'id_cliente',
            'nombre',
            'razon_social',
            'direccion',
            'estado',
            'codigo_postal',
            'email:email',
            'telefono',
            'whatsapp',
            'fecha_registro',
            'delegacion_mpio',
            'rfc',
            'id_usuario',
            'fecha_nacimiento',
            'apellido_materno',
            'apellido_paterno',
        ],
    ]) ?>

</div>
