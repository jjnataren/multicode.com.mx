<?php

namespace frontend\modules\api\v1\resources;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class EventoAlarma extends \backend\models\EventoAlarma
{
    public function fields()
    {
        return ['ID_ALARMA', 'ESTATUS', 'FECHA_SUCESO'];
    }

    
    /**
    public function extraFields()
    {
        return ['userProfile'];
    }
    
    */
}
