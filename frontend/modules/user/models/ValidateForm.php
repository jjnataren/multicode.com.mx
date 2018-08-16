<?php

namespace frontend\modules\user\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ValidateForm extends Model
{
    public $numero_serie;
    public $codigo_registro;
    public $verifyCode;
    

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['numero_serie', 'verifyCode','codigo_registro'], 'required'],
            // We need to sanitize them
            ['verifyCode', 'captcha','captchaAction' => '/user/sign-in/captcha'],

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'numero_serie' => Yii::t('frontend', 'Número de serie'),
            'verifyCode' => Yii::t('frontend', 'Verification Code')
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
