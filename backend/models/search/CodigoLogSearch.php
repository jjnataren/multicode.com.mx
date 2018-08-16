<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CodigoLog;

/**
 * CodigoLogSearch represents the model behind the search form about `backend\models\CodigoLog`.
 */
class CodigoLogSearch extends CodigoLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cliente'], 'integer'],
            [['numero_serie', 'fecha', 'dispositivo', 'activacion', 'codigo_respuesta', 'reactivacion', 'sistema_operativo', 'token_generado'], 'safe'],
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
        $query = CodigoLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cliente' => $this->cliente,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'numero_serie', $this->numero_serie])
            ->andFilterWhere(['like', 'dispositivo', $this->dispositivo])
            ->andFilterWhere(['like', 'activacion', $this->activacion])
            ->andFilterWhere(['like', 'codigo_respuesta', $this->codigo_respuesta])
            ->andFilterWhere(['like', 'reactivacion', $this->reactivacion])
            ->andFilterWhere(['like', 'sistema_operativo', $this->sistema_operativo])
            ->andFilterWhere(['like', 'token_generado', $this->token_generado]);

        return $dataProvider;
    }
}
