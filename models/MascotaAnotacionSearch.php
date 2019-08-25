<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anotacion;
use app\models\MascotaAnotacion;

/**
 * AnotacionSearch represents the model behind the search form of `app\models\Anotacion`.
 */
class MascotaAnotacionSearch extends MascotaAnotacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_anotacion', 'id_mascota'], 'integer'],
            [['anotacion', 'fecha','nombre'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = MascotaAnotacion::find();

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
            'id_anotacion' => $this->id_anotacion,
            'id_mascota' => $this->id_mascota,
            'fecha' => $this->fecha,
        ]);

        $query->andFilterWhere(['like', 'anotacion', $this->anotacion]);
        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
