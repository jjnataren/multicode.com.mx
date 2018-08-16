<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_solicitud_robo".
 *
 * @property integer $id_solicitud_robo
 * @property string $numero_serie
 * @property string $fecha_robo
 * @property string $fecha_solicitud
 * @property string $descripcion
 * @property string $acta_robo
 * @property integer $estatus
 * @property string $fecha_validacion
 * @property string $fecha_desactivar
 * @property string $fecha_captura
 * @property Producto $numeroSerie
 */
class SolicitudRobo extends \yii\db\ActiveRecord
{
	
const STATUS_CREADO = 1;
const STATUS_VALIDADO = 2;
const STATUS_RECHAZADO = 3;
const STATUS_ACEPTADO = 4;
	

public static $estados = [
		self::STATUS_CREADO=>'Reporte creado',
		self::STATUS_VALIDADO=>'Reporte validado por el cliente',
		self::STATUS_RECHAZADO=>'Reporte rechazado',
		self::STATUS_ACEPTADO=>'Reporte aceptado',
		
];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_solicitud_robo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_solicitud_robo'], 'integer'],
            [['id_solicitud_robo', 'estatus'], 'integer'],
            [['fecha_robo','fecha_captura', 'fecha_solicitud','fecha_validacion','fecha_desactivar'], 'safe'],
            [['numero_serie'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 200],
            [['acta_robo'], 'string', 'max' => 45],
            [['numero_serie'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['numero_serie' => 'numero_serie']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_solicitud_robo' => 'Id Solicitud Robo',
            'numero_serie' => 'Número de serie',
            'fecha_robo' => 'Fecha de robo',
            'fecha_solicitud' => 'Fecha de solicitud',
            'descripcion' => 'Descripción',
            'acta_robo' => 'Acta de robo',
            'estatus' => 'Estado',
        	'fecha_desactivar'=>'Fecha de desactivación',
        	'fecha_validacion'=>'Fecha de validación'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeroSerie()
    {
        return $this->hasOne(Producto::className(), ['numero_serie' => 'numero_serie']);
    }
    
    public function getEstadoRepore(){
    
    	return isset(SolicitudRobo::$estados[$this->estatus])?SolicitudRobo::$estados[$this->estatus]:'No definido';
    
    }
    
    

    /**
     * Return detail of status
     */
    public function getEstatusDescripcion(){
    	return isset( SolicitudRobo::$estados[$this->estatus])? SolicitudRobo::$estados[$this->estatus] : 'Desconocido';
    }
    
    
}
