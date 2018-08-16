<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_catalogo_evento".
 *
 * @property integer $ID_EVENTO
 * @property string $NOMBRE
 * @property string $DESCRIPCION
 * @property integer $ACTIVO
 */
class CatalogoEvento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_catalogo_evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACTIVO'], 'integer'],
            [['NOMBRE', 'DESCRIPCION'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_EVENTO' => 'Id  Evento',
            'NOMBRE' => 'Nombre',
            'DESCRIPCION' => 'Descripcion',
            'ACTIVO' => 'Activo',
        ];
    }
}
