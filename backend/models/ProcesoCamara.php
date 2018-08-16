<?php
namespace backend\models;


class ProcesoCamara{
	
		
		
	/**
	 * Returns current state
	 * @param int $current_state
	 * @param int $event
	 */
	public static function getState($current_state, $event){
		
		$estado     =  -1;
		
		$state_machine  = [
					
				Camara::S1_UNKNOW=>[
						CatalogoEvento::EV_ALERT_SELF_OK=>Camara::S2_LISTEN
				],
				Camara::S2_LISTEN=>[
						CatalogoEvento::EV_ALERT_SELF_OK=>Camara::S2_LISTEN,
						CatalogoEvento::EV_POWER_SUPLY_OUT=>Camara::S3_ERROR,
						CatalogoEvento::EV_CONTROL_DANGER_BUTTONON=>Camara::S4_DANGER,
						CatalogoEvento::EV_MAP_SHOW_CAM=>Camara::S5_WATCHING,
				],
		
				Camara::S5_WATCHING=>[
						CatalogoEvento::EV_VIDEO_ON_ERROR=>Camara::S2_LISTEN,
						CatalogoEvento::EV_MAP_STOP_VIDEO=>Camara::S2_LISTEN,
						CatalogoEvento::EV_ALERT_SELF_OK=>Camara::S5_WATCHING,
				],
					
					
				Camara::S3_ERROR=>[
						CatalogoEvento::EV_ALERT_SELF_OK=>Camara::S2_LISTEN,
						CatalogoEvento::EV_POWER_SUPLY_ON=>Camara::S2_LISTEN,
				],
					
				Camara::S4_DANGER=>[
						CatalogoEvento::EV_MAP_SHOW_CAM=>Camara::S6_WATCHING_DANGER,
						CatalogoEvento::EV_CONTROL_DANGER_BUTTON_OFF=>Camara::S2_LISTEN,
						CatalogoEvento::EV_ALERT_SELF_OK=>Camara::S4_DANGER,
				],
		
				Camara::S6_WATCHING_DANGER=>[
						CatalogoEvento::EV_VIDEO_ON_ERROR=>Camara::S4_DANGER,
						CatalogoEvento::EV_MAP_STOP_VIDEO=>Camara::S4_DANGER,
						CatalogoEvento::EV_ALERT_SELF_OK=>Camara::S6_WATCHING_DANGER,
				],
					
		] ;
		
		$estado =  isset($state_machine[$current_state][$event]) ? $state_machine[$current_state][$event] : -1;
		
		return $estado;
		
	}
	
	
}