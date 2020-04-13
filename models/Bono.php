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
 * @property integer $dias
 * @property integer $horas
 * @property string $jornada
 * @property string $tipo_bono 
 */
class Bono extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bono';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'precio'], 'required'],
            [['caducidad','dias','horas'], 'integer'],
            [['precio'], 'number'],
            [['tipo','tipo_bono','jornada'], 'string', 'max' => 100],
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
            'tipo_bono' => 'Tipo del Bono',
            'dias' => 'Dias',
            'horas' => 'Horas',
            'jornada' => 'Jornada',
        ];
    }
}
