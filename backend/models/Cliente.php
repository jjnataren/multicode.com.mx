<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tbl_cliente".
 *
 * @property integer $id_cliente
 * @property string $nombre
 * @property string $razon_social
 * @property string $direccion
 * @property integer $estado
 * @property integer $codigo_postal
 * @property string $email
 * @property integer $telefono
 * @property string $whatsapp
 * @property string $fecha_registro
 * @property integer $delegacion_mpio
 * @property string $rfc
 * @property integer $id_usuario
 * @property string $fecha_nacimiento
 * @property string $apellido_materno
 * @property string $apellido_paterno
 *
 * @property User $idUsuario
 * @property CodigoLog[] $codigoLogs
 * @property Producto[] $productos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'codigo_postal', 'telefono', 'delegacion_mpio', 'id_usuario'], 'integer'],
            [['fecha_registro', 'fecha_nacimiento'], 'safe'],
            [['nombre', 'direccion', 'apellido_materno', 'apellido_paterno'], 'string', 'max' => 300],
            [['razon_social', 'email', 'whatsapp'], 'string', 'max' => 100],
            [['rfc'], 'string', 'max' => 45],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_cliente' => 'Id Cliente',
            'nombre' => 'Nombre',
            'razon_social' => 'Razón Social',
            'direccion' => 'Direccion',
            'estado' => 'Estatus',
            'codigo_postal' => 'Codigo Postal',
            'email' => 'Email',
            'telefono' => 'Teléfono',
            'whatsapp' => 'Whatsapp',
            'fecha_registro' => 'Fecha de registro',
            'delegacion_mpio' => 'Delegacion Mpio',
            'rfc' => 'RFC',
            'id_usuario' => 'Id Usuario',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'apellido_materno' => 'Apellido Materno',
            'apellido_paterno' => 'Apellido Paterno',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoLogs()
    {
        return $this->hasMany(CodigoLog::className(), ['cliente' => 'id_cliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['id_propietario' => 'id_cliente']);
    }
}
