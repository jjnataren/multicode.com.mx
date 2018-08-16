<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SolicitudRobo;


/**
 * SolicitudRoboSearch represents the model behind the search form about `backend\models\SolicitudRobo`.
 */
class SolicitudRoboSearch extends SolicitudRobo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_solicitud_robo', 'estatus'], 'integer'],
            [['numero_serie', 'fecha_robo', 'fecha_solicitud', 'descripcion', 'acta_robo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SolicitudRobo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_solicitud_robo' => $this->id_solicitud_robo,
            'fecha_robo' => $this->fecha_robo,
            'fecha_solicitud' => $this->fecha_solicitud,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'numero_serie', $this->numero_serie])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'acta_robo', $this->acta_robo]);

        return $dataProvider;
    }
    
    // aqui se metoe el metodo dataprovaider
    
    public function searchRobo($params,$elements,$state)
    {
    	 
    	if ($elements){
    		$query = SolicitudRobo::find()->where(['not in','numero_serie',$elements]);
    	}else{
    		$query = SolicitudRobo::find();
    	}
    	 
    	 
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	 
    	 
    	$query->andFilterWhere(['estatus'=>$state]);
    	 
    
    	if (!($this->load($params) && $this->validate())) {
    		return $dataProvider;
    	}
    
    	$query->andFilterWhere([
    			'id_solicitud_robo' => $this->id_solicitud_robo,
    			'fecha_solicitud' => $this->fecha_solicitud,
    			'fecha_robo' => $this->fecha_robo,
    			'acta_robo' => $this->acta_robo,
    			'estatus'=>'1'
    	]);
    
    	$query->andFilterWhere(['like', 'numero_serie', $this->numero_serie])
    	 
    	->andFilterWhere(['like', 'descripcion', $this->descripcion]);
    	 
    	 
    
    	return $dataProvider;
    }
    
}
