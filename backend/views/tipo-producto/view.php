<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TipoProducto */

$this->title ='Tipo producto Id ' . $model->id_tipo_producto;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-producto-view">

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id_tipo_producto], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['delete', 'id' => $model->id_tipo_producto], [
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
            'id_tipo_producto',
            'nombre',
        		'precio_base',
            'descripcion',
        		
        		['attribute'=> 'categoria',
        		'value'=>$model->getCategoriaProducto()
        		],
        		
            ['attribute'=> 'activo',
            'value'=>($model->activo)?'Si':'No'		
    		],
        ],
    ]) ?>
        
     <img class="img-thumbnail" style="width:350px; height:250px;" src="<?= isset ($model->path)? $model->base.'/' . $model->path : '/img/clipboard.png'?>" alt="" /> 

</div>
