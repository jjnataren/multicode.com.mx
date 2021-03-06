<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_producto".
 *
 * @property string $numero_serie
 * @property integer $numero_orden
 * @property integer $tipo_producto
 * @property string $fecha_fabricacion
 * @property integer $estado
 * @property string $codigo_registro
 * @property double $precio_sugerido
 * @property string $descripcion
 * @property string $urlimg
 * @property integer $id_propietario
 * @property string $id_provedor
 * @property string $fecha_asigno_provedor
 * @property string $fecha_adquirio_cliente
 * @property string $path_documento_probatorio
 * @property string $fecha_registro
 * @property string $fecha_valido_proveedor
 * @property string $email_valido_producto
 * @property string $seguro_robo
 * @property integer $servicio_app
 *
 * @property Venta $numeroOrden
 * @property Proveedor $idProvedor
 * @property Cliente $idPropietario
 * @property TipoProducto $tipoProducto
 */
class Producto extends \yii\db\ActiveRecord
{
	const STATUS_CREATED = 1;
	const STATUS_ASIGNDED_PROVIDER = 2;
	const STATUS_VALIDATED_PROVIDER = 3;
	const STATUS_SOLED_CLIENT = 4;
	const STATUS_REGISTRED_CLIENT = 5;
	const STATUS_STOLED_PROCESS =6;
	const STATUS_GUARANTED_PROCESS = 7;
	const STATUS_DEACTIVATED = 8;
	
	const STATUS_PENDING = 0;

	public $categoria;
	
	
	public static $estados = [self::STATUS_CREATED=>'Creado, listo para asignar',
			self::STATUS_ASIGNDED_PROVIDER=>'Asignado a proveedor',
			self::STATUS_VALIDATED_PROVIDER=>'Validado por el proveedor',
			self::STATUS_SOLED_CLIENT=>'Vendido a cliente',
			self::STATUS_REGISTRED_CLIENT=>'Registrado por el cliente',
			self::STATUS_STOLED_PROCESS=>'Reporte de robo',
			self::STATUS_GUARANTED_PROCESS=>'En proceso de garantía',
			self::STATUS_DEACTIVATED=>'Desactivado por robo',
			self::STATUS_PENDING=>'Pendiente',
	];
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_serie','tipo_producto','precio_sugerido','codigo_registro'], 'required'],
        	[['numero_serie'], 'unique'],
            [['numero_orden', 'tipo_producto', 'estado', 'id_propietario','seguro_robo', 'servicio_app'], 'integer'],
            [['fecha_fabricacion' ,'fecha_asigno_provedor', 'fecha_adquirio_cliente', 'fecha_registro', 'fecha_valido_proveedor'], 'safe'],
            [['precio_sugerido'], 'number'],
            [['numero_serie', 'codigo_registro'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 300],
        	[['numero_serie'],'string', 'length'=>[8,16], 'message'=>'Este campo debe tener 16 caracteres.'],
            [['urlimg', 'path_documento_probatorio'], 'string', 'max' => 400],
            [['email_valido_producto'], 'string', 'max' => 200],
            [['numero_orden'], 'exist', 'skipOnError' => true, 'targetClass' => Venta::className(), 'targetAttribute' => ['numero_orden' => 'numero_orden']],
            [['id_provedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['id_provedor' => 'clave_proveedor']],
            [['id_propietario'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['id_propietario' => 'id_cliente']],
            [['tipo_producto'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProducto::className(), 'targetAttribute' => ['tipo_producto' => 'id_tipo_producto']],
        	[['id_provedor' ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
			 'numero_serie' => 'Número de serie ',
            'tipo_producto' => 'Tipo de producto',
            'fecha_fabricacion' => 'Fecha de fabricación',
            'estado' => 'Estado',
            'codigo_registro' => 'Código de registro',
            'precio_sugerido' => 'Precio sugerido ',
            'descripcion' => 'Descripción',
            'urlimg' => 'Urlimg',
            'id_propietario' => 'Id Propietario',
            'id_provedor' => 'Clave de proveedor',
            'fecha_asigno_provedor' => 'Fecha Asigno Provedor',
            'fecha_adquirio_cliente' => 'Fecha Adquirio Cliente',
            'path_documento_probatorio' => 'Path Documento Probatorio',
            'fecha_registro' => 'Fecha Registro',
            'fecha_valido_proveedor' => 'Fecha Valido Proveedor',
        	'email_valido_producto'=>'Correo electronico valido producto',	
        	'seguro_robo'=>'Seguro robo',
        	'servicio_app'=>'Servicio app'		
        		];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeroOrden()
    {
        return $this->hasOne(Venta::className(), ['numero_orden' => 'numero_orden']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProvedor()
    {
        return $this->hasOne(Proveedor::className(), ['clave_proveedor' => 'id_provedor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPropietario()
    {
        return $this->hasOne(Cliente::className(), ['id_cliente' => 'id_propietario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProducto()
    {
        return $this->hasOne(TipoProducto::className(), ['id_tipo_producto' => 'tipo_producto']);
    }
    
    public function getEstadoProducto(){
    	 
    	return isset(Producto::$estados[$this->estado])?Producto::$estados[$this->estado]:'No definido';
    	 
    }
    
    /**
     *Get detailed description of a  particular producto 
     */
    public function getTipoNombreProducto(){
    		
    		return isset( $this->tipoProducto) ?
    				$this->tipoProducto->getCategoriaProducto() .' - ' . $this->tipoProducto->nombre : 'No definido';
    	
    }
    
    
    /**
     * Gets detail of product
     */
   	public function  getEstadoProductoDetail(){
   		
   		return  isset (Producto::$estados[$this->estado]) ? Producto::$estados[$this->estado] : 'no definido';
   		
   	}
    
    
}
