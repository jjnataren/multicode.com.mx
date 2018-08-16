<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ValidateForm extends Model
{
    public $numero_serie;
    public $verifyCode;
    public $fechaAdquirio;
    public $idProveedor;
    public $otro;
    public $comentario;
    public $correo_electronico_proveedor;
    public $codigo_registro;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['numero_serie','codigo_registro', 'verifyCode','idProveedor','correo_electronico_proveedor'], 'required','message'=>'Este campo es requerido'],
            // We need to sanitize them
       		['fechaAdquirio', 'safe'],
            ['verifyCode', 'captcha','message'=>'Código de validación incorrecto'],
        		['correo_electronico_proveedor', 'email','message'=>'Correo electrónico no valido'],
        	
        		[['numero_serie'],'string', 'length'=>[8,16], 'message'=>'Este campo debe tener 16 caracteres.'],
        	

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'numero_serie' => Yii::t('frontend', 'Número de serie','idProveedor'),
            'verifyCode' => Yii::t('frontend', 'Verification Code'),
        		'fechaAdquirio' => Yii::t('frontend', 'Fecha en que adquirio el producto'),
        		'idProveedor' => Yii::t('frontend', 'Proveedor autorizado'),
        		'correo_electronico_proveedor'=>'Correo electrónico'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            return Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom(Yii::$app->params['robotEmail'])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
        } else {
            return false;
        }
    }
}
