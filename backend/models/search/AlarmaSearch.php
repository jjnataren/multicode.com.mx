<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Alarma;

/**
 * AlarmaSearch represents the model behind the search form about `backend\models\Alarma`.
 */
class AlarmaSearch extends Alarma
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_ALARMA', 'ACTIVO'], 'integer'],
            [['NOMBRE', 'DESCRIPCION', 'LAT', 'LONG', 'DIRECCION', 'TELEFONO_RESPONSABLE', 'NOMBRE_RESPONSABLE'], 'safe'],
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
        $query = Alarma::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID_ALARMA' => $this->ID_ALARMA,
            'ACTIVO' => $this->ACTIVO,
        ]);

        $query->andFilterWhere(['like', 'NOMBRE', $this->NOMBRE])
            ->andFilterWhere(['like', 'DESCRIPCION', $this->DESCRIPCION])
            ->andFilterWhere(['like', 'LAT', $this->LAT])
            ->andFilterWhere(['like', 'LONG', $this->LONG])
            ->andFilterWhere(['like', 'DIRECCION', $this->DIRECCION])
            ->andFilterWhere(['like', 'TELEFONO_RESPONSABLE', $this->TELEFONO_RESPONSABLE])
            ->andFilterWhere(['like', 'NOMBRE_RESPONSABLE', $this->NOMBRE_RESPONSABLE]);

        return $dataProvider;
    }
}
