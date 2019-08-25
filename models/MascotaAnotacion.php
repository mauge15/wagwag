<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mascota_anotacion".
 *
 * @property integer $id_mascota
 * @property integer $id_anotacion
 * @property string $nombre
 * @property string $anotacion
 * @property string $fecha
 */
class MascotaAnotacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mascota_anotacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mascota', 'id_anotacion'], 'integer'],
            [['nombre'], 'required'],
            [['anotacion'], 'string'],
            [['fecha'], 'safe'],
            [['nombre'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_mascota' => 'Id Mascota',
            'id_anotacion' => 'Id Anotacion',
            'nombre' => 'Nombre',
            'anotacion' => 'Anotacion',
            'fecha' => 'Fecha',
        ];
    }
    public static function primaryKey()
    {
        return ['id_anotacion'];
    }
}
