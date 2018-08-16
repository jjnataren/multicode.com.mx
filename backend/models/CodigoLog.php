<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_codigo_log".
 *
 * @property integer $id
 * @property string $numero_serie
 * @property integer $cliente
 * @property string $fecha
 * @property string $dispositivo
 * @property string $activacion
 * @property string $codigo_respuesta
 * @property string $reactivacion
 * @property string $sistema_operativo
 * @property string $token_generado
 *
 * @property Cliente $cliente0
 * @property Producto $numeroSerie
 */
class CodigoLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_codigo_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cliente'], 'integer'],
            [['fecha'], 'safe'],
            [['numero_serie', 'sistema_operativo'], 'string', 'max' => 100],
            [['dispositivo', 'activacion', 'codigo_respuesta', 'reactivacion', 'token_generado'], 'string', 'max' => 45],
            [['cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['cliente' => 'id_cliente']],
            [['numero_serie'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['numero_serie' => 'numero_serie']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero_serie' => 'Numero Serie',
            'cliente' => 'Cliente',
            'fecha' => 'Fecha',
            'dispositivo' => 'Dispositivo',
            'activacion' => 'Activacion',
            'codigo_respuesta' => 'Codigo Respuesta',
            'reactivacion' => 'Reactivacion',
            'sistema_operativo' => 'Sistema Operativo',
            'token_generado' => 'Token Generado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente0()
    {
        return $this->hasOne(Cliente::className(), ['id_cliente' => 'cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNumeroSerie()
    {
        return $this->hasOne(Producto::className(), ['numero_serie' => 'numero_serie']);
    }
}
