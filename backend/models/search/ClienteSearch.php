<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Cliente;

/**
 * ClienteSearch represents the model behind the search form about `backend\models\Cliente`.
 */
class ClienteSearch extends Cliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_cliente', 'estado', 'codigo_postal', 'telefono', 'delegacion_mpio', ], 'integer'],
            [['nombre','id_usuario', 'razon_social', 'direccion', 'email', 'whatsapp', 'fecha_registro', 'rfc', 'fecha_nacimiento', 'apellido_materno', 'apellido_paterno'], 'safe'],
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
    	
    	
    	
        $query = Cliente::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query = Cliente::findBySql("select * from tbl_cliente where id_usuario in (select id from tbl_user where username like '%$this->id_usuario%')");
        
        $dataProvider = new ActiveDataProvider([
        		'query' => $query,
        ]);
        
        
        $query->andFilterWhere([
            'id_cliente' => $this->id_cliente,
            'estado' => $this->estado,
            'codigo_postal' => $this->codigo_postal,
            'telefono' => $this->telefono,
            'fecha_registro' => $this->fecha_registro,
            'delegacion_mpio' => $this->delegacion_mpio,
            'fecha_nacimiento' => $this->fecha_nacimiento,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'whatsapp', $this->whatsapp])
            ->andFilterWhere(['like', 'rfc', $this->rfc])
            ->andFilterWhere(['like', 'apellido_materno', $this->apellido_materno])            
            ->andFilterWhere(['like', 'apellido_paterno', $this->apellido_paterno]);
            

        return $dataProvider;
    }
}
