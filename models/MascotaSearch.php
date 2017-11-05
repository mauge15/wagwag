<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mascota;

/**
 * MascotaSearch represents the model behind the search form about `app\models\Mascota`.
 */
class MascotaSearch extends Mascota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'chip', 'id_raza', 'esterilizado', 'adoptado', 'id_protectora', 'id_historial_medico', 'id_historial_comportamiento'], 'integer'],
            [['nombre', 'fecha_nac', 'sexo', 'fecha_ult_celo'], 'safe'],
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
        $query = Mascota::find();

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
            'fecha_nac' => $this->fecha_nac,
            'chip' => $this->chip,
            'id_raza' => $this->id_raza,
            'esterilizado' => $this->esterilizado,
            'fecha_ult_celo' => $this->fecha_ult_celo,
            'adoptado' => $this->adoptado,
            'id_protectora' => $this->id_protectora,
            'id_historial_medico' => $this->id_historial_medico,
            'id_historial_comportamiento' => $this->id_historial_comportamiento,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'sexo', $this->sexo]);

        return $dataProvider;
    }
}
