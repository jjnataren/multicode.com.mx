<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Producto;

/**
 * ProductoSearch represents the model behind the search form about `backend\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_serie', 'fecha_fabricacion', 'estado', 'descripcion'], 'safe'],
            [['tipo_producto', 'codigo_registro'], 'integer'],
            [['precio_sugerido'], 'number'],
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
        $query = Producto::find();
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        	'sort' => ['attributes' => ['numero_serie','fecha_registro']]	
        ]);

        if (!($this->load($params) && $this->validate())) {
        	//$query->orderBy('fecha_registro desc');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tipo_producto' => $this->tipo_producto,
           // 'fecha_fabricacion' => $this->fecha_fabricacion,
           // 'codigo_registro' => $this->codigo_registro,
            'precio_sugerido' => $this->precio_sugerido,
        	'estado' => $this->estado,
        ]);

        $query->andFilterWhere(['like', 'numero_serie', $this->numero_serie]);
        
        

        return $dataProvider;
    }
    
    
    
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchNotIn($params,$elements,$state)
    {
    	
    	if ($elements){
    	$query = Producto::find()->where(['not in','numero_serie',$elements]);
    	}else{
    		$query = Producto::find();
    	}
    	
    	
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    			'pagination' => [ 'pageSize' => 8 ],
    	]);
    	
    	
    	$query->andFilterWhere(['estado'=>$state]);
    	
    
    	if (!($this->load($params) && $this->validate())) {
    		return $dataProvider;
    	}
    
    	$query->andFilterWhere([
    			'tipo_producto' => $this->tipo_producto,
    			'fecha_fabricacion' => $this->fecha_fabricacion,
    			'codigo_registro' => $this->codigo_registro,
    			'precio_sugerido' => $this->precio_sugerido,
    			'estado'=>'1'
    	]);
    
    	$query->andFilterWhere(['like', 'numero_serie', $this->numero_serie])
    	
    	->andFilterWhere(['like', 'descripcion', $this->descripcion]);
    	
    	
    
    	return $dataProvider;
    }
}
