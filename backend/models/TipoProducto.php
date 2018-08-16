<?php

namespace backend\models;

use Yii;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "tbl_tipo_producto".
 *
 * @property integer $id_tipo_producto
 * @property string $nombre
 * @property string $descripcion
 * @property integer $activo
 * @property string $imagen_url
 * @property integer $categoria
 * @property string $base
 * @property string $path
 * @property double $precio_base
 * @property string $caracteristica1
 * @property string $caracteristica2
 * @property string $caracteristica3
 * @property string $caracteristica4
 
 *
 * @property Producto[] $productos
 */
class TipoProducto extends \yii\db\ActiveRecord
{
	
	const CATEGORIA_MULTICODE = 1;
	const CATEGORIA_ACCESORIO = 2;
	
	/**
	 * 
	 * @var unknown
	 */
	public static $categoriaDesc  = [self::CATEGORIA_ACCESORIO=>'Accesorio',
									 self::CATEGORIA_MULTICODE=>'Multicode'
	];
	
	/**
	 * @var
	 */
	public $imagen_url;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tipo_producto';
    }


    /**
     * @return array
     */
    public function behaviors()
    {
    	return [
    			'imagen_url' => [
    					'class' => UploadBehavior::className(),
    					'attribute' => 'imagen_url',
    					'pathAttribute' => 'path',
    					'baseUrlAttribute' => 'base'
    			]
    	];
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activo', 'categoria'], 'integer'],
        	[['precio_base'],'double'],	
        	[['caracteristica1','caracteristica2','caracteristica3','caracteristica4'],'string', 'max'=>100],	
            [['nombre'], 'string', 'max' => 200],
            [['descripcion'], 'string', 'max' => 400],
            [['imagen_url'], 'safe'],
            [['base', 'path'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_tipo_producto' => 'Id Tipo de producto',
            'nombre' => 'Nombre',
        	'caracteristica1'=>'Caracteristica',
        	'caracteristica2'=>'Caracteristica',
        	'caracteristica3'=>'Caracteristica',
        	'caracteristica4'=>'Caracteristica',
            'descripcion' => 'Descripción',
            'activo' => 'Activo',
            'imagen_url' => 'Imagen',
            'categoria' => 'Categoría',
            'base' => 'Base',
            'path' => 'Path',
        		'precio_base'=>'Precio sugerido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['tipo_producto' => 'id_tipo_producto']);
    }
    
    
    /**
     *Return category description 
     *
     */
    public function getCategoriaProducto(){
    	
    	return isset (TipoProducto::$categoriaDesc[$this->categoria]) ? TipoProducto::$categoriaDesc[$this->categoria] : 'No definida';
    }
    
}
