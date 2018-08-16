<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_venta".
 *
 * @property integer $numero_orden
 * @property string $clave_proveedor
 * @property double $precio_publico
 * @property string $fecha_venta
 * @property string $estatus
 * @property integer $garantia
 * @property integer $seguro_robo
 * @property string $comentarios
 * @property integer $tipo_pago
 * @property integer $descuento
 * @property double $monto_total
 * @property string $fecha_venta_real
 * @property integer $iva
 *
 * @property Producto[] $productos
 * @property Proveedor $claveProveedor
 */
class Venta extends \yii\db\ActiveRecord
{
   
	
	
	public $tmpIdVenta;
	public $precioIva;
	
	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_venta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['clave_proveedor'], 'required'],
            [['precio_publico', 'monto_total'], 'number'],
            [['garantia', 'seguro_robo', 'tipo_pago', 'descuento','iva'], 'integer'],
            [['clave_proveedor', 'fecha_venta', 'estatus'], 'string', 'max' => 100],
            [['comentarios'], 'string', 'max' => 400],
        	[['fecha_venta_real','precioIva'], 'safe',],
            [['clave_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['clave_proveedor' => 'clave_proveedor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'numero_orden' => 'Número de orden',
            'clave_proveedor' => 'Clave de proveedor',
            'precio_publico' => 'Precio al público ',
            'fecha_venta' => 'Fecha de venta',
            'estatus' => 'Estatus',
            'garantia' => 'Garantía',
            'seguro_robo' => 'Seguro contra robo',
            'comentarios' => 'Comentarios',
            'tipo_pago' => 'Tipo pago',
            'descuento' => 'Descuento',
            'monto_total' => 'Monto total',
        		'fecha_venta_real'=>'Fecha en que se ejecuto la venta'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['numero_orden' => 'numero_orden']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaveProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['clave_proveedor' => 'clave_proveedor']);
    }
}
