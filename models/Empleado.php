<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "EMPLEADO".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $dni
 */
class Empleado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'EMPLEADO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'dni'], 'required'],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['dni'], 'string', 'max' => 11],
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
            'apellido' => 'Apellido',
            'dni' => 'Dni',
        ];
    }
}
