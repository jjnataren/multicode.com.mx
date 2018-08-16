<?php

namespace backend\models;

use Yii;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the model class for table "tbl_promocion".
 *
 * @property integer $id_promocion
 * @property string $titulo
 * @property string $descripcion
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property integer $estatus
 * @property string $imagen_url
 * @property string $base
 * @property string $path
 */
class Promocion extends \yii\db\ActiveRecord
{
	
	/**
	 * @var
	 */
	public $imagen_url;
	
	
	/**
	 * @return array
	 */
	public function behaviors()
	{
		return [
				'imagen_url' => [
						'class' => UploadBehavior::className(),
						'attribute' => 'imagen_url',
						'pathAttribute' => 'path',
						'baseUrlAttribute' => 'base'
				]
		];
	}
	
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_promocion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_inicio', 'fecha_fin','imagen_url'], 'safe'],
            [['estatus'], 'integer'],
            [['titulo'], 'string', 'max' => 300],
            [['descripcion', ], 'string', 'max' => 500],
            [['base', 'path'], 'string', 'max' => 400],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_promocion' => 'Id promoción',
            'titulo' => 'Titulo',
            'descripcion' => 'Descripción',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'estatus' => 'Activo',
            'imagen_url' => 'Imagen Url',
            'base' => 'Base',
            'path' => 'Path',
        ];
    }
}
