<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Venta;

/**
 * VentaSearch represents the model behind the search form about `backend\models\Venta`.
 */
class VentaSearch extends Venta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_orden', 'clave_proveedor', 'garantia', 'seguro_robo', 'tipo_pago', 'descuento'], 'integer'],
            [[ 'fecha_venta', 'estatus', 'comentarios'], 'safe'],
            [['precio_publico', 'monto_total'], 'number'],
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
        $query = Venta::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'numero_orden' => $this->numero_orden,
            'clave_proveedor' => $this->clave_proveedor,
            'precio_publico' => $this->precio_publico,
            'fecha_venta' => $this->fecha_venta,
            'garantia' => $this->garantia,
            'seguro_robo' => $this->seguro_robo,
            'tipo_pago' => $this->tipo_pago,
            'descuento' => $this->descuento,
            'monto_total' => $this->monto_total,
        ]);

        $query->andFilterWhere(['like', 'estatus', $this->estatus])
            ->andFilterWhere(['like', 'comentarios', $this->comentarios]);

        return $dataProvider;
    }
}
