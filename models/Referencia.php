<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referencia".
 *
 * @property integer $id
 * @property string $tipo
 */
class Referencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 100],
        ];
    }

//public function relations()
//{
//	return array(
//		'propietarios' => array(self::HAS_MANY, 'Propietario', 'id_propietario')
//	)
//}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
        ];
    }
}
