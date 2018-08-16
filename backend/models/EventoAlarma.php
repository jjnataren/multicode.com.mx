<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_evento_alarma".
 *
 * @property integer $ID_EVENTO
 * @property integer $ID_ALARMA
 * @property string $NOMBRE
 * @property string $DESCRIPCION
 * @property integer $ESTATUS
 * @property integer $TIPO_EVENTO
 * @property integer $ACTIVO
 * @property string $FECHA_SUCESO
 * @property string $IMGURL
 *
 * @property Alarma $iDALARMA
 */
class EventoAlarma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_evento_alarma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_ALARMA', 'ESTATUS', 'TIPO_EVENTO', 'ACTIVO'], 'integer'],
            [['FECHA_SUCESO'], 'safe'],
            [['NOMBRE', 'DESCRIPCION', 'IMGURL'], 'string', 'max' => 200],
            [['ID_ALARMA'], 'exist', 'skipOnError' => true, 'targetClass' => Alarma::className(), 'targetAttribute' => ['ID_ALARMA' => 'ID_ALARMA']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_EVENTO' => 'Id  Evento',
            'ID_ALARMA' => 'Id  Alarma',
            'NOMBRE' => 'Nombre',
            'DESCRIPCION' => 'Descripcion',
            'ESTATUS' => 'Estatus',
            'TIPO_EVENTO' => 'Tipo  Evento',
            'ACTIVO' => 'Activo',
            'FECHA_SUCESO' => 'Fecha  Suceso',
            'IMGURL' => 'Imgurl',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIDALARMA()
    {
        return $this->hasOne(Alarma::className(), ['ID_ALARMA' => 'ID_ALARMA']);
    }
}
