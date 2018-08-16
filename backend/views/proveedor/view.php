<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\CatCatalogo;

/* @var $this yii\web\View */
/* @var $model backend\models\Proveedor */

$this->title = 'Ver proveedor: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['titleIcon'] = '<span class="fa-stack fa-lg">
  								<i class="fa fa-square-o fa-stack-2x"></i>
  								<i class="fa fa-eye fa-stack-1x"></i>
							   </span>';
							   

$pais = CatCatalogo::findOne($model->pais);
$estado = CatCatalogo::findOne($model->estado);

?>
<div class="proveedor-view">

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->clave_proveedor], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Eliminar', ['delete', 'id' => $model->clave_proveedor], [
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
            'clave_proveedor',
            'nombre',
            'telefono',
            'direccion',
            'email:email',
            'whatsapp',
        		['attribute'=> 'pais',
        		'value'=>isset($pais)?$pais->NOMBRE : 'no establecido'
        		],
        		['attribute'=> 'estado',
        		'value'=>isset($estado)?$estado->NOMBRE : 'no establecido'
        				],
        		
        ],
    ]) ?>

</div>
