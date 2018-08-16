<?php

namespace backend\controllers;

use Yii;
use backend\models\Proveedor;
use backend\models\search\ProveedorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use trntv\filekit\actions\UploadAction;
use trntv\filekit\actions\DeleteAction;
use Intervention\Image\ImageManagerStatic;
use backend\models\CatCatalogo;


/**
 * ProveedorController implements the CRUD actions for Proveedor model.
 */
class ProveedorController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    
    
    /**
     * (non-PHPdoc)
     * @see \yii\base\Controller::actions()
     */
    public function actions()
    {
    	return [
    			'avatar-upload' => [
    					'class' => UploadAction::className(),
    					'deleteRoute' => 'avatar-delete',
    					'on afterSave' => function ($event) {
    						/* @var $file \League\Flysystem\File */
    						$file = $event->file;
    						$img = ImageManagerStatic::make($file->read())->fit(215, 215);
    						$file->put($img->encode());
    					}
    			],
    			'avatar-delete' => [
    					'class' => DeleteAction::className()
    			]
    			];
    }
    

    /**
     * Lists all Proveedor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProveedorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    
    /**
     * retrives all child  of particular partent 
     * @param unknown $id
     */
    public function  actionGetPaisEstados($id){
    	
    	//verificar si hay atributo de activo
    	$estados = CatCatalogo::findAll(['CATEGORIA'=>1,'ELEMENTO_PADRE'=>$id]);
    	
    	
    	if($estados){
    		foreach($estados as $estado){
    			echo "<option value='".$estado->ID_ELEMENTO."'>".$estado->NOMBRE."</option>";
    		}
    	}
    	else{
    		echo "<option>--</option>";
    	}
    	
    	
    	
    }
    
    /**
     * Displays a single Proveedor model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Proveedor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proveedor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->clave_proveedor]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Proveedor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->clave_proveedor]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Proveedor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Proveedor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proveedor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proveedor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
