<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HistorialMedico;

/**
 * HistorialMedicoSearch represents the model behind the search form about `app\models\HistorialMedico`.
 */
class HistorialMedicoSearch extends HistorialMedico
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['enf_cardiaca', 'ale_alimentaria', 'ale_cutanea', 'otras_limit', 'cancer', 'enf_endocrina', 'otras'], 'safe'],
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
        $query = HistorialMedico::find();

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
        ]);

        $query->andFilterWhere(['like', 'enf_cardiaca', $this->enf_cardiaca])
            ->andFilterWhere(['like', 'ale_alimentaria', $this->ale_alimentaria])
            ->andFilterWhere(['like', 'ale_cutanea', $this->ale_cutanea])
            ->andFilterWhere(['like', 'otras_limit', $this->otras_limit])
            ->andFilterWhere(['like', 'cancer', $this->cancer])
            ->andFilterWhere(['like', 'enf_endocrina', $this->enf_endocrina])
            ->andFilterWhere(['like', 'otras', $this->otras]);

        return $dataProvider;
    }
}
