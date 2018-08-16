<?php

namespace backend\models;

use Yii;
use trntv\filekit\behaviors\UploadBehavior;
use phpDocumentor\Reflection\Types\Integer;

/**
 * This is the model class for table "tbl_proveedor".
 *
 * @property string $clave_proveedor
 * @property string $nombre
 * @property string $telefono
 * @property string $direccion
 * @property string $email
 * @property string $whatsapp
 * @property string $img_path
 * @property string $img_base
 * @property string $imagen
 * @property string $descripcion
 * @property string $pais
 * @property string $estado
 * @property string $facebook_url
 * @property string $sitio_url
 * 
 * @property Producto[] $productos
 * @property Venta[] $ventas
 */
class Proveedor extends \yii\db\ActiveRecord
{
	
	public $imagen;
	
	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
				'imagen' => [
						'class' => UploadBehavior::className(),
						'attribute' => 'imagen',
						'pathAttribute' => 'img_path',
						'baseUrlAttribute' => 'img_base'
				]
		];
	}
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_proveedor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clave_proveedor'], 'required'],
            [['clave_proveedor', 'nombre', 'direccion', 'email','telefono'], 'string', 'max' => 100],
            [['whatsapp','estado'], 'string', 'max' => 45],
        	[['imagen'], 'safe'],
            [['pais', ], 'integer'],
        		[['facebook_url', 'sitio_url'], 'string', 'max' => 300],
            [['img_path', 'img_base','descripcion'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'clave_proveedor' => 'Clave del Proveedor',
            'nombre' => 'Nombre',
            'telefono' => 'Teléfono',
            'direccion' => 'Dirección',
            'email' => 'Email',
            'whatsapp' => 'Whatsapp',
            'img_path' => 'Img Path',
            'img_base' => 'Img Base',
        	'imagen'=>'Logotipo',
        	'descripcion'=>'Descripción',	
        	'estado'=>'Estado',
        	'pais'=>'Pais',
        	'municipio'=>'Municipio',
        		'facebook_url'=>'Facebook',
        		'sitio_url'=>'Sitio web'
        		
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['id_provedor' => 'clave_proveedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['clave_proveedor' => 'clave_proveedor']);
    }
}
