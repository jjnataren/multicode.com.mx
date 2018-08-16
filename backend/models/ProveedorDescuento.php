<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_proveedor_descuento".
 *
 * @property integer $clave_proveedor
 * @property integer $id_descuento
 * @property integer $activo
 *
 * @property Descuento $idDescuento
 * @property Proveedor $claveProveedor
 */
class ProveedorDescuento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_proveedor_descuento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['clave_proveedor', 'id_descuento', 'activo'], 'integer'],
            [['id_descuento'], 'exist', 'skipOnError' => true, 'targetClass' => Descuento::className(), 'targetAttribute' => ['id_descuento' => 'id_descuento']],
            [['clave_proveedor'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['clave_proveedor' => 'clave_proveedor']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'clave_proveedor' => 'Clave Proveedor',
            'id_descuento' => 'Id Descuento',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDescuento()
    {
        return $this->hasOne(Descuento::className(), ['id_descuento' => 'id_descuento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClaveProveedor()
    {
        return $this->hasOne(Proveedor::className(), ['clave_proveedor' => 'clave_proveedor']);
    }
}
