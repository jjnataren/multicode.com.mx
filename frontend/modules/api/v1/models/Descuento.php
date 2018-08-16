<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "tbl_descuento".
 *
 * @property integer $id_descuento
 * @property string $nombre
 * @property string $descripcion
 * @property integer $porcentaje
 * @property integer $activo
 *
 * @property ProveedorDescuento[] $proveedorDescuentos
 * @property Venta[] $ventas
 */
class Descuento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_descuento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['porcentaje', 'activo'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_descuento' => 'Id Descuento',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'porcentaje' => 'Porcentaje',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProveedorDescuentos()
    {
        return $this->hasMany(ProveedorDescuento::className(), ['id_descuento' => 'id_descuento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Venta::className(), ['descuento' => 'id_descuento']);
    }
}
