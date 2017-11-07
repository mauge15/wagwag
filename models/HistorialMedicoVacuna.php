<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "HISTMEDICO_VACUNA".
 *
 * @property integer $id
 * @property integer $id_histmedico
 * @property integer $id_vacuna
 * @property string $fecha
 */
class HistorialMedicoVacuna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'HISTMEDICO_VACUNA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_histmedico', 'id_vacuna', 'fecha'], 'required'],
            [['id_histmedico', 'id_vacuna'], 'integer'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_histmedico' => 'Id Histmedico',
            'id_vacuna' => 'Id Vacuna',
            'fecha' => 'Fecha',
        ];
    }
}
