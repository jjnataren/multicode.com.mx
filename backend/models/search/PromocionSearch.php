<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Promocion;

/**
 * PromocionSearch represents the model behind the search form about `backend\models\Promocion`.
 */
class PromocionSearch extends Promocion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_promocion', 'estatus'], 'integer'],
            [['titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'imagen_url'], 'safe'],
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
        $query = Promocion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_promocion' => $this->id_promocion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'estatus' => $this->estatus,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'imagen_url', $this->imagen_url]);

        return $dataProvider;
    }
}
