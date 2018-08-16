<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Garantia;

/**
 * GarantiaSearch represents the model behind the search form about `backend\models\Garantia`.
 */
class GarantiaSearch extends Garantia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_solicitud', 'estatus'], 'integer'],
            [['numero_serie', 'fecha_solicitud', 'fecha_ingreso_garantia', 'fecha_valido_cliente', 'fecha_envio', 'folio_envio', 'numero_guia', 'comentarios', 'fecha_recibio_cliente'], 'safe'],
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
        $query = Garantia::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_solicitud' => $this->id_solicitud,
            'fecha_solicitud' => $this->fecha_solicitud,
            'fecha_ingreso_garantia' => $this->fecha_ingreso_garantia,
            'fecha_valido_cliente' => $this->fecha_valido_cliente,
            'estatus' => $this->estatus,
            'fecha_envio' => $this->fecha_envio,
            'fecha_recibio_cliente' => $this->fecha_recibio_cliente,
        ]);

        $query->andFilterWhere(['like', 'numero_serie', $this->numero_serie])
            ->andFilterWhere(['like', 'folio_envio', $this->folio_envio])
            ->andFilterWhere(['like', 'numero_guia', $this->numero_guia])
            ->andFilterWhere(['like', 'comentarios', $this->comentarios]);

        return $dataProvider;
    }
}
