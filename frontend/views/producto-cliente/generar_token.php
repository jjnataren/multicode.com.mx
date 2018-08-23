<?php


use trntv\filekit\widget\Upload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\captcha\Captcha;
use backend\models\Proveedor;
use yii\helpers\ArrayHelper;
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
<?php $form = ActiveForm::begin(); ?>
<div class="col-md-offset-3 col-md-6 col-xs-12 col-sm-12">



      <div class="panel panel-default">

        <div class="panel-body">


	       <?= $form->field($model, 'numero_serie', ['template' =>
		     		'<div class="form-group">
                    {label}
		       		 <div class="input-group">
		          <span class="input-group-addon" >
		             <span class="glyphicon glyphicon-barcode"></span>
		          </span>
		          {input}

		       </div>

		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'No. Serie Producto','class'=>'form-control input-lg','readonly'=>'readonly'])->label('Número de serie'); ?>


	       <?= $form->field($model, 'codigo_respuesta', ['template' =>
		     		'<div class="form-group">
                     {label}
		       		 <div class="input-group">

		          <span class="input-group-addon" >

		             <span class="fa fa-car"></span>
		          </span>

		          {input}

		       </div>

		      <div> {error}{hint}</div>
   				</div>'])->textInput(['placeholder' => 'Código de respuesta','class'=>'form-control input-lg'])->label('Código de respuesta'); ?>






	       <?= $form->field($model, 'activacion')->radioList(['1'=>'Activación','0'=>'Desbloqueo'],[])->label('Activación o desbloqueo'); ?>





	</div>




	</div>

</div>

<div class="col-md-offset-3 col-md-6 col-xs-12 col-sm-12">

		<div class="col-md-offset-3 col-md-6 col-xs-12 col-sm-12">
		     <?php echo Html::submitButton('<i class="fa fa-key"></i> Generar  token &nbsp;&nbsp;&nbsp;', ['class' => 'btn btn-primary btn-lg']) ?>

		</div>

		<div class="col-md-offset-3 col-md-6 col-xs-12 col-sm-12">
		</div>

		<div class="col-md-offset-3 col-md-6 col-xs-12 col-sm-12">

        <?php echo Html::a('<i class="fa fa-list"></i> Seleccionar otro', ['mis-productos'], ['class' => 'btn btn-primary btn-lg']) ?>
		</div>
	</div>



	</div>


	<?php ActiveForm::end(); ?>
	</div>




</div>
