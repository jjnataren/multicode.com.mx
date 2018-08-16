<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_cat_catalogo".
 *
 * @property integer $ID_ELEMENTO
 * @property string $CLAVE
 * @property integer $ELEMENTO_PADRE
 * @property string $NOMBRE
 * @property string $DESCRIPCION
 * @property integer $ORDEN
 * @property integer $CATEGORIA
 * @property integer $ACTIVO
 */
class CatCatalogo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cat_catalogo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ELEMENTO_PADRE', 'ORDEN', 'CATEGORIA', 'ACTIVO'], 'integer'],
            [['CLAVE'], 'string', 'max' => 100],
            [['NOMBRE'], 'string', 'max' => 600],
            [['DESCRIPCION'], 'string', 'max' => 2048],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_ELEMENTO' => 'Id  Elemento',
            'CLAVE' => 'Clave',
            'ELEMENTO_PADRE' => 'Elemento  Padre',
            'NOMBRE' => 'Nombre',
            'DESCRIPCION' => 'Descripcion',
            'ORDEN' => 'Orden',
            'CATEGORIA' => 'Categoria',
            'ACTIVO' => 'Activo',
        ];
    }
}
