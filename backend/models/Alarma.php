<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_alarma".
 *
 * @property integer $ID_ALARMA
 * @property string $NOMBRE
 * @property string $DESCRIPCION
 * @property string $LAT
 * @property string $LONG
 * @property integer $ACTIVO
 * @property string $DIRECCION
 * @property string $TELEFONO_RESPONSABLE
 * @property string $NOMBRE_RESPONSABLE
 *
 * @property Dispositivo[] $dispositivos
 * @property EventoAlarma[] $eventoAlarmas
 */
class Alarma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_alarma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_ALARMA'], 'required'],
            [['ID_ALARMA', 'ACTIVO'], 'integer'],
            [['NOMBRE', 'DESCRIPCION', 'LAT', 'LONG', 'DIRECCION', 'TELEFONO_RESPONSABLE', 'NOMBRE_RESPONSABLE'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_ALARMA' => 'Id  Alarma',
            'NOMBRE' => 'Nombre',
            'DESCRIPCION' => 'Descripcion',
            'LAT' => 'Lat',
            'LONG' => 'Long',
            'ACTIVO' => 'Activo',
            'DIRECCION' => 'Direccion',
            'TELEFONO_RESPONSABLE' => 'Telefono  Responsable',
            'NOMBRE_RESPONSABLE' => 'Nombre  Responsable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDispositivos()
    {
        return $this->hasMany(Dispositivo::className(), ['ID_ALARMA' => 'ID_ALARMA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventoAlarmas()
    {
        return $this->hasMany(EventoAlarma::className(), ['ID_ALARMA' => 'ID_ALARMA']);
    }
}
