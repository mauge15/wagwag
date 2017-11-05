<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BonoComprado;

/**
 * BonoCompradoSearch represents the model behind the search form about `app\models\BonoComprado`.
 */
class BonoCompradoSearch extends BonoComprado
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_mascota', 'id_bono', 'id_propietario', 'dias_utilizados', 'dias_bono'], 'integer'],
            [['fecha_compra', 'fecha_caducidad'], 'safe'],
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
        $query = BonoComprado::find();

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
            'id' => $this->id,
            'id_mascota' => $this->id_mascota,
            'id_bono' => $this->id_bono,
            'id_propietario' => $this->id_propietario,
            'fecha_compra' => $this->fecha_compra,
            'fecha_caducidad' => $this->fecha_caducidad,
            'dias_utilizados' => $this->dias_utilizados,
            'dias_bono' => $this->dias_bono,
        ]);

        return $dataProvider;
    }
}
