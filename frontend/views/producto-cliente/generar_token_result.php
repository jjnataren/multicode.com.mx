<?php


use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\captcha\Captcha;
use backend\models\Proveedor;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model common\base\MultiModel */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('frontend', 'Generar token');

$provedoresDataList = ArrayHelper::map ( Proveedor::findBySql('select * from tbl_proveedor')->all(), 'clave_proveedor', 'nombre' );


?>


 <!-- Start Page Banner -->
    <div class="page-banner no-subtitle">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h2>Generar token</h2>
          </div>
          <div class="col-md-6">
            <ul class="breadcrumbs">
              <li><a href="mis-productos">Inicio</a></li>

              <li>Generar token</li>
            </ul>
          </div>
        </div>
      </div>
    </div>


<div id="content">
<div class="container">
<div class="col-md-offset-3 col-md-6 col-xs-12 col-sm-12">



      <div class="panel panel-success">

        <div class="panel-body">


		 <h4 class="classic-title"><span>Generación de token exitosa</span></h4>

		<input type="text" class="form-control input-lg" readonly="readonly" value="<?=$model->token_generado ?>"/>


		<br />
		   <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'numero_serie',
            'fecha',
            ['attribute'=> 'activacion','value'=>$model->activacion?'Activación':'Re-activación'],
            'codigo_respuesta',
            'token_generado',
        ],
    ]) ?>

	</div>

 	<div class="panel-footer">

		<?= \yii\bootstrap\Html::a('Generar nuevo token',['generar-token','serie'=>$model->numero_serie],['class'=>'btn btn-primary'])?>
		<?= \yii\bootstrap\Html::a('Ver otro producto',['mis-productos','serie'=>$model->numero_serie],['class'=>'btn btn-primary'])?>

	</div>


	</div>
	</div>
	</div>


</div>
