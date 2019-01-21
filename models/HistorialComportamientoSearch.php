<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistorialComportamiento;

/**
 * HistorialComportamientoSearch represents the model behind the search form about `app\models\HistorialComportamiento`.
 */
class HistorialComportamientoSearch extends HistorialComportamiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_mascota', 'ha_mordido', 'ha_sido_mordido', 'miedo_perro', 'id_temperamento'], 'integer'],
            [['juega_perros', 'juega_personas', 'persona_desconocida', 'otra_info'], 'safe'],
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
        $query = HistorialComportamiento::find();

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
            'ha_mordido' => $this->ha_mordido,
            'ha_sido_mordido' => $this->ha_sido_mordido,
            'miedo_perro' => $this->miedo_perro,
            'id_temperamento' => $this->id_temperamento,
        ]);

        $query->andFilterWhere(['like', 'juega_perros', $this->juega_perros])
            ->andFilterWhere(['like', 'juega_personas', $this->juega_personas])
            ->andFilterWhere(['like', 'persona_desconocida', $this->persona_desconocida])
            ->andFilterWhere(['like', 'otra_info', $this->otra_info]);

        return $dataProvider;
    }
}
