<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Crear cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_cliente',
        		[
        		'attribute'=>'id_usuario',
        		'content'=>function($data){
        			return  isset($data->idUsuario)?Html::a($data->idUsuario->username,['user/view','id'=>$data->id_usuario],['target'=>'_blank']) :'(No definido)';
        		},
        		'header'=>'Usuario acceso'
        		],
        		
            'nombre',
        	'apellido_paterno',
            //'razon_social',
            //'direccion',
            //'estado',
            // 'codigo_postal',
             'email:email',
             'telefono',
            // 'whatsapp',
             'fecha_registro',
            // 'delegacion_mpio',
            // 'rfc',
            // 'id_usuario',
            // 'fecha_nacimiento',
            // 'apellido_materno',
            // 'apellido_paterno',
            
        		
        
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
