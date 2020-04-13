<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "VACUNA".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $duracion_mes
 */
class Vacuna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacuna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['duracion_mes'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'duracion_mes' => 'Duracion Mes',
        ];
    }
}
