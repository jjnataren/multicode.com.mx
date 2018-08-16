<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Producto;

/* @var $this yii\web\View */
/* @var $model backend\models\Cliente */

$this->title ='Id cliente ' . $model->id_cliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
<div class="col-md-6 col-xs-12 col-sm-12">

    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id_cliente], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['delete', 'id' => $model->id_cliente], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Realmente quiere borrar este cliente?',
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

<div class="col-md-6 col-xs-12 col-sm-12">
<h2>
	Productos relacionados
</h2>


<table class="table table-hover">
	<thead>
		<tr>
			<th>
				#Serie
			</th>
			<th>
				Tipo producto
			</th>
			<th>
				Estado del producto
			</th>
			<th>
				Opción
			</th>
			
		</tr>
	</thead>
	<tbody>
		<?php foreach ($model->productos as $producto):?>
		
		<tr>
			<td>
				<?= $producto->numero_serie;?>
			</td>
			<td>
				<?= $producto->tipoProducto ? $producto->tipoProducto->nombre : 'no definido';  ?>
			</td>
			<td>
				<?= Producto::$estados[$producto->estado] ? Producto::$estados[$producto->estado] : 'no definido';  ?>
			</td>
			<td>
				 <?php echo Html::a('<i class="fa fa-eye"></i> ver', ['producto/view', 'id' => $producto->numero_serie], ['class' => 'btn btn-primary','target'=>'_blank']) ?>
			</td>
			
		</tr>
		
		<?php endforeach;?>
	</tbody>
 </table>

</div>
</div>
