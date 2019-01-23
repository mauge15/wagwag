<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ANOTACION".
 *
 * @property int $id
 * @property int $id_mascota
 * @property string $anotacion
 * @property string $fecha
 */
class Anotacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ANOTACION';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mascota'], 'required'],
            [['id_mascota'], 'integer'],
            [['anotacion'], 'string'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_mascota' => 'Id Mascota',
            'anotacion' => 'Anotacion',
            'fecha' => 'Fecha',
        ];
    }
}
