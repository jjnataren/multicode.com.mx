<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_dispositivo".
 *
 * @property integer $ID_DISPOSITIVO
 * @property string $CORREO_ELECTRONICO
 * @property string $UID_FIREBASE
 * @property integer $ID_ALARMA
 * @property string $TELEFONO
 *
 * @property Alarma $iDALARMA
 */
class Dispositivo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_dispositivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CORREO_ELECTRONICO', 'UID_FIREBASE', 'TELEFONO'], 'required'],
            [['ID_ALARMA'], 'integer'],
            [['CORREO_ELECTRONICO', 'UID_FIREBASE'], 'string', 'max' => 200],
            [['TELEFONO'], 'string', 'max' => 10],
            [['ID_ALARMA'], 'exist', 'skipOnError' => true, 'targetClass' => Alarma::className(), 'targetAttribute' => ['ID_ALARMA' => 'ID_ALARMA']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_DISPOSITIVO' => 'Id  Dispositivo',
            'CORREO_ELECTRONICO' => 'Correo  Electronico',
            'UID_FIREBASE' => 'Uid  Firebase',
            'ID_ALARMA' => 'Id  Alarma',
            'TELEFONO' => 'Telefono',
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
