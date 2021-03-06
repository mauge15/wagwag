<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "VETERINARIO".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $telefono
 */
class Veterinario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'veterinario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['telefono'], 'integer'],
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
            'telefono' => 'Telefono',
        ];
    }
}
