<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Propietario;

/**
 * PropietarioSearch represents the model behind the search form about `app\models\Propietario`.
 */
class PropietarioSearch extends Propietario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'telefono', 'cod_postal', 'id_Veterinario', 'id_referencia'], 'integer'],
            [['nombre', 'apellido', 'dni', 'direccion', 'email', 'persona_contacto'], 'safe'],
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
        $query = Propietario::find();

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
            'telefono' => $this->telefono,
            'cod_postal' => $this->cod_postal,
            'id_Veterinario' => $this->id_Veterinario,
            'id_referencia' => $this->id_referencia,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'persona_contacto', $this->persona_contacto]);

        return $dataProvider;
    }
}
