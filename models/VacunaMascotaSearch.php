<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VacunaMascota;

/**
 * VacunaMascotaSearch represents the model behind the search form about `app\models\VacunaMascota`.
 */
class VacunaMascotaSearch extends VacunaMascota
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_mascota', 'id_vacuna'], 'integer'],
            [['fecha', 'proxima_fecha','propietarioName','mascotaName','vacunaName'], 'safe'],
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
        $query = VacunaMascota::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'id',
                'propietarioName' => [
                    'asc' => ['propietarioName' => SORT_ASC],
                    'desc' => ['propietarioName' => SORT_DESC],
                    'label' => 'Propietario',
                    'default' => SORT_ASC
                ],
                'mascotaName' => [
                    'asc' => ['mascotaName' => SORT_ASC],
                    'desc' => ['mascotaName' => SORT_DESC],
                    'label' => 'Mascota',
                    'default' => SORT_ASC
                ],
                'vacunaName' => [
                    'asc' => ['vacunaName' => SORT_ASC],
                    'desc' => ['vacunaName' => SORT_DESC],
                    'label' => 'Vacuna',
                    'default' => SORT_ASC
                ],
                'fecha' => [
                    'asc' => ['fecha' => SORT_ASC],
                    'desc' => ['fecha' => SORT_DESC],
                    'label' => 'Fecha',
                    'default' => SORT_ASC
                ],
                'proxima_fecha' => [
                    'asc' => ['proxima_fecha' => SORT_ASC],
                    'desc' => ['proxima_fecha' => SORT_DESC],
                    'label' => 'Próxima Fecha',
                    'default' => SORT_ASC
                ],
            ]
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
            'id_vacuna' => $this->id_vacuna,
            'fecha' => $this->fecha,
        ]);

         // filter by custom condition
        // filter by country name
        /*$query->joinWith(['propietario' => function ($q) {
            $q->where('propietario.nombre LIKE "%' . $this->propietarioName . '%"');
        }]);*/
        return $dataProvider;
    }
}
