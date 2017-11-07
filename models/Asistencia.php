<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ASISTENCIA".
 *
 * @property integer $id
 * @property integer $id_mascota
 * @property string $llegada
 * @property string $salida
 */
class Asistencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ASISTENCIA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mascota'], 'required'],
            [['id_mascota'], 'integer'],
            [['llegada', 'salida'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_mascota' => 'Id Mascota',
            'llegada' => 'Llegada',
            'salida' => 'Salida',
        ];
    }
}
