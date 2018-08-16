<?php

namespace backend\models;

use Yii;
use backend\models\Producto;

/**
 * This is the model class for table "tbl_garantia".
 *
 * @property integer $id_solicitud
 * @property string $numero_serie
 * @property string $fecha_solicitud
 * @property string $fecha_ingreso_garantia
 * @property string $fecha_valido_cliente
 * @property integer $estatus
 * @property string $fecha_envio
 * @property string $folio_envio
 * @property string $numero_guia
 * @property string $comentarios
 * @property string $fecha_recibio_cliente
 * @property string $motivo_garantia
 * @property string $diagnostico
 * @property string $comentarios_cliente
 * @property string $fecha_captura
 *
 * @property Producto $numeroSerie
 */
class Garantia extends \yii\db\ActiveRecord
{
	
	
	const STATUS_REGISTERED = 1;
	const STATUS_SENT_CLIENT = 2;
	const STATUS_RECEIVED_CLIENT = 3;
	const STATUS_VALIDATED_CLIENT = 4;
	const STATUS_REJECTED_CLIENT = 4;
	

	public static $estados = [self::STATUS_REGISTERED=>'Se ha registrado la solicitud de garantía',
			self::STATUS_SENT_CLIENT=>'El producto se ha enviado al cliente',
			self::STATUS_RECEIVED_CLIENT=>'Producto recibido por el cliente',
			self::STATUS_VALIDATED_CLIENT=>'Producto validado por el cliente',
			self::STATUS_REJECTED_CLIENT=>'Producto rechazado por el cliente',
	];
	
	
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_garantia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_solicitud', 'fecha_captura', 'fecha_ingreso_garantia', 'fecha_valido_cliente', 'fecha_envio', 'fecha_recibio_cliente'], 'safe'],
            [['estatus'], 'integer'],
            [['numero_serie', 'folio_envio', 'numero_guia'], 'string', 'max' => 100],
        	[['numero_serie'], 'required'],
            [['comentarios','motivo_garantia','diagnostico','comentarios_cliente'], 'string', 'max' => 300],
            [['numero_serie'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['numero_serie' => 'numero_serie']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_solicitud' => 'Id Solicitud',
            'numero_serie' => 'Numero Serie',
            'fecha_solicitud' => 'Fecha Solicitud',
            'fecha_ingreso_garantia' => 'Fecha Ingreso Garantia',
            'fecha_valido_cliente' => 'Fecha Valido Cliente',
            'estatus' => 'Estatus',
            'fecha_envio' => 'Fecha de envio',
            'folio_envio' => 'Folio de  envio',
            'numero_guia' => 'Numero de guía',
            'comentarios' => 'Comentarios',
            'fecha_recibio_cliente' => 'Fecha en que recibio el cliente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeroSerie()
    {
        return $this->hasOne(Producto::className(), ['numero_serie' => 'numero_serie']);
    }
    
    
    
    /**
     * Return detail of status
     */
   	public function getEstatusDescripcion(){
   		return isset( Garantia::$estados[$this->estatus])? Garantia::$estados[$this->estatus] : 'Desconocido';
   	}
   	
   	
    
    
}
