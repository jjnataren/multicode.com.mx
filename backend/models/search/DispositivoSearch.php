<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dispositivo;

/**
 * DispositivoSearch represents the model behind the search form about `backend\models\Dispositivo`.
 */
class DispositivoSearch extends Dispositivo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_DISPOSITIVO', 'ID_ALARMA'], 'integer'],
            [['CORREO_ELECTRONICO', 'UID_FIREBASE', 'TELEFONO'], 'safe'],
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
        $query = Dispositivo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ID_DISPOSITIVO' => $this->ID_DISPOSITIVO,
            'ID_ALARMA' => $this->ID_ALARMA,
        ]);

        $query->andFilterWhere(['like', 'CORREO_ELECTRONICO', $this->CORREO_ELECTRONICO])
            ->andFilterWhere(['like', 'UID_FIREBASE', $this->UID_FIREBASE])
            ->andFilterWhere(['like', 'TELEFONO', $this->TELEFONO]);

        return $dataProvider;
    }
}
