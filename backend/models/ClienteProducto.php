<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_cliente_producto".
 *
 * @property integer $id_cliente
 * @property integer $id_producto
 * @property string $fecha_registro
 */
class ClienteProducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cliente_producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cliente', 'id_producto'], 'integer'],
            [['fecha_registro'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Id Cliente',
            'id_producto' => 'Id Producto',
            'fecha_registro' => 'Fecha Registro',
        ];
    }
}
