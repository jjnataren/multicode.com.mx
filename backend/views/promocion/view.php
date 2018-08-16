<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Promocion */

$this->title = 'Promoción Id. ' .  $model->id_promocion;
$this->params['breadcrumbs'][] = ['label' => 'Promociones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

<div class="col-md-12 col-xs-12 col-sm-12">
    <p>
        <?php echo Html::a('Actualizar', ['update', 'id' => $model->id_promocion], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Borrar', ['detele', 'id' => $model->id_promocion], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Esta seguro de eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>    

<div class="col-md-4 col-xs-12 col-sm-12" >

<img class="img-thumbnail" style="width:350px; height:250px;" src="<?= isset ($model->path)? $model->base.'/' . $model->path : '/img/clipboard.png'?>" alt="" />
</div>

<div class="col-md-8 col-xs-12 col-sm-12" >
    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_promocion',
            'titulo',
            'descripcion',
            'fecha_inicio',
            'fecha_fin',
            ['attribute'=> 'estatus',
            'value'=>($model->estatus)?'Si':'No'		
    		],
            
        ],
    ]) ?>

</div>
</div>
