<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "BONO".
 *
 * @property integer $id
 * @property string $tipo
 * @property integer $caducidad
 * @property double $precio
 */
class Bono extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'BONO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'precio'], 'required'],
            [['caducidad'], 'integer'],
            [['precio'], 'number'],
            [['tipo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'caducidad' => 'Caducidad',
            'precio' => 'Precio',
        ];
    }
}
