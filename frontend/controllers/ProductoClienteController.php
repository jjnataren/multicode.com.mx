<?php
namespace frontend\controllers;

use Yii;
use frontend\models\ContactForm;
use frontend\models\ValidateForm;
use yii\web\Controller;
use yii\base\Object;
use yii\helpers\Json;
use backend\models\CodigoLog;
use backend\models\Venta;
use backend\models\Cliente;
use backend\models\Producto;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ProductoClienteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }



    /**
     * devuelve todos los productos relacionados a un clietne
     * @throws NotFoundHttpException
     * @return \yii\web\Response|string
     */
    public function actionMisProductos()
    {

        /*$model = new ContactForm();

        $cliente = Cliente::findOne(Yii::$app->user->identity->id);

        if(!$cliente) throw new NotFoundHttpException('The requested page does not exist.');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options'=>['class'=>'alert-success']
                ]);
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'There was an error sending email.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }*/


    	$cliente = Cliente::findOne(['id_usuario'=> Yii::$app->user->identity->id]);

    	if(!$cliente) throw new NotFoundHttpException('The requested page does not exist.');

    	$model = new Producto();

    	$productos = Producto::findBySql('select * from tbl_producto where id_propietario = :id and estado > :estado ',[':id'=>$cliente->id_cliente, ':estado'=>2])->all();

        return $this->render('index', [
            'model' => $model,
        	'productos'=>$productos
        ]);

    }




    /**
     * Genera token de un producto
     * @throws NotFoundHttpException
     * @return \yii\web\Response|string
     */
    public function actionGenerarToken($serie)
    {



        $cliente = Cliente::findOne(['id_usuario'=> Yii::$app->user->identity->id]);

        if(!$cliente) throw new NotFoundHttpException('The requested page does not exist.');

        $model = Producto::findOne($serie);


        if(!$model ||  $model->servicio_app !== 1){



            Yii::$app->getSession()->setFlash('alert', [
                'body' =>'<h2>El producto no cuenta con el servicio para generar token.</h2>',
                'options' => ['class'=>'alert-success']
            ]);


            return $this->redirect('mis-productos');
        }


        if( $model->id_propietario !== $cliente->id_cliente ){

            Yii::$app->getSession()->setFlash('alert', [
                'body' =>'<h2>El producto no esta asociado al cliente.</h2>',
                'options' => ['class'=>'alert-success']
            ]);


            return $this->redirect('mis-productos');

        }





           $codigoLog = new CodigoLog();

           $codigoLog->scenario = CodigoLog::SCENARIO_WAPP;

           $codigoLog->numero_serie = $serie;

           if ($codigoLog->load(Yii::$app->request->post())) {



              if( $this->generateToken($codigoLog, $cliente, $model) )

               return $this->render('generar_token_result', [
                   'model' => $codigoLog,

               ]);


           }


        return $this->render('generar_token', [
            'model' => $codigoLog,

        ]);

    }







    /**
     *
     * @param CodigoLog $model
     * @param Cliente $cliente
     * @param Producto $producto
     * @throws \yii\web\HttpException
     * @return boolean[]|string[]
     */
    private function generateToken($model,$cliente,$producto){





        $lastCode   = CodigoLog::findBySql("select * from tbl_codigo_log where numero_serie  = '$producto->numero_serie' order by fecha desc")->one();


        if(  !isset($model->codigo_respuesta) || strlen($model->codigo_respuesta) < 8   ||  (  isset($lastCode)  && hexdec ( substr($lastCode->codigo_respuesta, -4) ) <= hexdec (substr( $model->codigo_respuesta,-4) ) ) ) {

            $model->addError('codigo_respuesta','Codigo de respuesta no valido: Revisa tus datos (numero de serie y codigo de repuesta) o apagar y prender el equipo nuevamente.');

            return false;

        }


        //Se obtiene arreglo por pares KCBA0114 => K,C,B,A,0,1,1,4
        $numeroSerieArray = str_split($model->numero_serie,1);

        $arrayLengh = count($numeroSerieArray);

        if ($arrayLengh < 8){ //Es necesario al menos 5 caracteres para extraer la base

            $model->addError('numero_serie','Numero de serie invalido.');

            return false;
        }



        $codigoRespuesta = substr( $model->codigo_respuesta, -4);


        $arrayLengh--;

        $hex1 = dechex( ord( $numeroSerieArray[$arrayLengh - 1 ] ) );  //penultimo caracter

        $hex2 = dechex( ord($numeroSerieArray[ $arrayLengh  ] ) ); //ultimo caracter

        $hex3 = dechex( ord( $numeroSerieArray[ $arrayLengh - 5 ] ) );

        $hex4 = dechex( ord( $numeroSerieArray[ $arrayLengh - 4 ] ) );

        //	throw new \yii\web\HttpException(500,'Numero de  serie no valido.');

        //no se aplica xor
        $codigoRespuestaXorString = $codigoRespuesta;

        $codigoRespuestaXorString = substr($codigoRespuestaXorString, -2);

        $codigoRespuestaArray =  str_split($codigoRespuestaXorString,1);

        $codigoRespHex1 = dechex(hexdec($codigoRespuestaArray[0]) ^ 0xF );

        $codigoRespHex2 = dechex( hexdec($codigoRespuestaArray[1]) ^ 0xF );

        //Primer base
        $stringHex = $hex1.$hex2.$hex3.$hex4.$codigoRespuesta;





        //XOR
        $codigoRespuestaXor = $codigoRespuestaXorString ^ 0xFFFF;

        $codigoRespuestaXorString =  substr('0000' . $codigoRespuestaXor,-4); //dechex($codigoRespuestaXor);




        $stringHexArray1 = str_split($stringHex,2);

        $hex1 =  dechex( hexdec($hex1)  +  ( hexdec($codigoRespHex2) * 2 )  );

        $hex2 =  dechex( hexdec( $hex2 ) + (hexdec($codigoRespHex1) ^ 0xF ) );

        $hex3 = dechex( hexdec( $hex3 ) +  hexdec($codigoRespHex1)  );

        $tmpHex4 =  (hexdec($codigoRespHex2) ^ 0xF );

        $hex4 =   dechex( hexdec( $hex4 ) + $tmpHex4 );




        //formateo en pares
        $sHex1 = '00'.$hex1;
        $sHex2 = '00'.$hex2;
        $sHex3 = '00'.$hex3;
        $sHex4 = '00'.$hex4;

        $sHex1 = substr($sHex1, -2);
        $sHex2 = substr($sHex2, -2);
        $sHex3 = substr($sHex3, -2);
        $sHex4 = substr($sHex4, -2);

        //segundo codigo base
        $stringHex = strtoupper($sHex1.$sHex2.$sHex3.$sHex4.$codigoRespuesta);


        if ($model->codigo_respuesta !==  strtoupper(substr($stringHex, -8)) ){


            $model->addError('codigo_respuesta','Codigo de respuesta no valido: Revisa tus datos (numero de serie y codigo de repuesta) o apagar y prender el equipo nuevamente. [2da base]');


           return false;
        }

        $stringHexArray =  str_split($stringHex, 2);

        $byteArray = [];

        foreach($stringHexArray as $hexString){

            $byteArray[] = hexdec ( $hexString );

        }


        $num = 0;
        $giris = [];
        $i = 0;

        for($i= 0; $i<6; $i++){

            for ($m=0; $m<8; $m++){

                if  (($byteArray[$i] >> $m ) & 1 ===  1) {
                    $num = $num + 1;
                }

            }

        }

        if (($num % 2) === 0) {
            $n = 0;
            for( $n = 0; $n<6; $n++){


                $giris[$n] = ($byteArray[5 - $n] ^ 0xFF);
            }
        }else{
            $num5 = 0;
            for( $num5 = 0; $num5 < 6; $num5++){
                $giris[$num5] = $byteArray[5 - $num5];
            }
        }

        $j = 0;
        $k = 0;
        $str = '';

        for( $j = 0; $j<$num; $j++){

            $this->rotate_array($giris,$giris);

        }

        $z = 1 + 1;

        $auxstr = '';

        for( $k = 0; $k< 6; $k++){

            $auxstr = ''.dechex($giris[$k]);

            if (strlen($auxstr) < 2){

                $auxstr = '0'.$auxstr;
            }

            $str = ($str . $auxstr);
        }



        $str_array= str_split($str, 1);

        if ($model->activacion) {//activacion o desbloqueo

            $tokengenerado = $str_array[0] . $str_array[1] . $str_array[6] .$str_array[9];

        }else{

            $tokengenerado = $str_array[9] . $str_array[1] . $str_array[6] .$str_array[0];
        }


        try {

            $model->token_generado = strtoupper($tokengenerado) ;

            $model->fecha = date("Y-m-d H:i:s");

            $model->cliente = $cliente->id_cliente;

            $model->save(false);

        } catch (\Exception $e) {

        }


        //Keep just 5  records peer device


        $modelsToDelete = CodigoLog::findBySql("select * from tbl_codigo_log where numero_serie = '$model->numero_serie' order by fecha desc" )->all();



        if (count($modelsToDelete) > 5 ){



            for($i=5; $i<count($modelsToDelete); $i++){
                $modelsToDelete[$i]->delete();
            }


        }

        return true;

    }



    public function  rotate_array($giris, &$cikis){

        $num= 0;
        $index = 0;

        $num = (($giris[0] & 1) === 1)?  1 : 0;

        $num = ($num << 1);
        $num = ($num) | ((($giris[1] & 1) === 1)? 1: 0);
        $num = ($num << 1);
        $num = ($num) | ((($giris[2] & 1) === 1)? 1: 0);
        $num = ($num << 1);


        $valueTest =  ( (($giris[3] & 1) === 1)? 1: 0 );

        $num = ($num) | ( (($giris[3] & 1) === 1)? 1: 0 );
        $num = ($num << 1);

        $num = ($num) | ((($giris[4] & 1) === 1)? 1: 0);
        $num = ($num << 1);
        $num = ($num) | ((($giris[5] & 1) === 1)? 1: 0);



        $cikis[0] = ($giris[0] >> 1);
        $cikis[0] = (($cikis[0] & 0x7F) | (($num & 1) << 7));

        for ($index = 1; $index < 6; $index++){

            $cikis[$index] = ($giris[$index] >> 1);
            $cikis[$index] = (($cikis[$index] & 0x7F) |  ((($num >> ((6 - $index) & 0x1F)) & 1) << 7));

        }

    }



    /**
     * Actualiza informacion del cliente
     */
    public function actionRegistroProducto(){

    	$cliente = Cliente::findOne(['id_usuario'=> Yii::$app->user->identity->id]);

    	if(!$cliente) throw new NotFoundHttpException('Usuario no registrado');

    	$productoModel = new ValidateForm();

    	if ($productoModel->load(Yii::$app->request->post())) {

    		$producto = Producto::findOne(['numero_serie'=>$productoModel->numero_serie, 'codigo_registro'=>$productoModel->codigo_registro]);

    		if($productoModel->fechaAdquirio){//hay valor en la fecha, entonces se formatea para mysql
    			$dateTmp = \DateTime::createFromFormat('d/m/Y', $productoModel->fechaAdquirio);
    			$productoModel->fechaAdquirio = $dateTmp->format('Y-m-d');
    		}

    		if(!$producto) $productoModel->addError('numero_serie','Producto no encontrado, revise  número de serie y  proveedor.');
    			else {

    				if ($producto->estado  > Producto::STATUS_VALIDATED_PROVIDER){

    					if ($producto->id_propietario ===  $cliente->id_cliente){

    					//	$productoModel->addError('numero_serie','');

    						Yii::$app->getSession()->setFlash('alert', [
    								'body'=>Yii::t('frontend', 'Ya se ha asociado el producto a su cuenta'),
    								'options'=>['class'=>'alert-info']
    						]);

    						$productoModel->addError('numero_serie','El producto ya esta asociado a su cuenta.');
    					}else
    						$productoModel->addError('numero_serie','Producto registrado  por  otro cliente, contacte al administrador');

    				}elseif ($producto->estado > Producto::STATUS_CREATED){

    						$producto->id_propietario	= 	$cliente->id_cliente;
    						$producto->estado	= Producto::STATUS_REGISTRED_CLIENT;
    						$producto->fecha_registro = date('Y-m-d');
    						$producto->fecha_adquirio_cliente = $productoModel->fechaAdquirio;

    						if($producto->save() ) {

    							//Linea de tiempo

    							Yii::$app->getSession()->setFlash('alert', [
    									'body'=>Yii::t('frontend', 'Producto registrado correctamente !'),
    									'options'=>['class'=>'alert-success']
    							]);



    						}else{

    							Yii::$app->getSession()->setFlash('alert', [
    									'body'=>Yii::t('frontend', '! No fue posible registrar el producto, intente mas tarde !'),
    									'options'=>['class'=>'alert-danger']
    							]);


    						}

    						return $this->redirect('mis-productos');

    				}else{

    					$productoModel->addError('numero_serie','Producto no disponible para registro');

    				}


    			}






    	}


    	return $this->render('registra-producto', [
    			'model' => $productoModel,
    	]);

    }




    public function actionValidateProducto()
    {
    	$model = new ValidateForm();
    	$modelResult = null;
    	$modelVentaResult = null;

    	if ($model->load(Yii::$app->request->post())) {

    		$modelResult = Producto::findOne($model->numero_serie);
    		$modelVentaResult = Venta::findOne(['numero_serie'=>$model->numero_serie]);

    		if ($modelResult || $modelVentaResult){

    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>Yii::t('frontend', 'Producto encontrado'),
    					'options'=>['class'=>'alert-success']
    			]);

    		}else{

    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>\Yii::t('frontend', 'El producto indicado no existe en inventario.'),
    					'options'=>['class'=>'alert-danger']
    			]);

    		}


    		/*
    		if ($model->contact(Yii::$app->params['adminEmail'])) {
    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
    					'options'=>['class'=>'alert-success']
    			]);
    			return $this->refresh();
    		} else {
    			Yii::$app->getSession()->setFlash('alert', [
    					'body'=>\Yii::t('frontend', 'There was an error sending email.'),
    					'options'=>['class'=>'alert-danger']
    			]);
    		}*/

    	}

    	return $this->render('validate-product', [
    			'model' => $model,
    			'modelResult' => $modelResult,
    			'modelVentaResult'=>$modelVentaResult
    	]);
    }



}
