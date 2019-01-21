<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "COMP_OBSERVADO".
 *
 * @property integer $id
 * @property integer $id_mascota
 * @property integer $id_empleado
 * @property string $descripcion
 */
class ComportamientoObservado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'COMP_OBSERVADO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mascota', 'id_empleado', 'descripcion'], 'required'],
            [['id_mascota', 'id_empleado'], 'integer'],
            [['descripcion'], 'string', 'max' => 400],
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
            'id_empleado' => 'Id Empleado',
            'descripcion' => 'Descripcion',
        ];
    }
}
