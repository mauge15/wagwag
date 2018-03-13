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
 * @property string $fecha
 * @property integer $tipo_asistencia

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
            [['id_mascota','tipo_asistencia'], 'integer'],
            [['llegada', 'salida','fecha'], 'safe'],
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
            'llegada' => 'Hora de Llegada',
            'salida' => 'Hora de Salida',
            'tipo_asistencia' => 'Tipo Jornada',
            'fecha'=>'Fecha',
        ];
    }

    public function beforeSave($insert) {
        // unix timestamp
        //$time = strtotime($this->fecha_nac);

        // if you want a specific format
        $time = date("Y-m-d", strtotime($this->fecha));
        // any other custom validations you need for your date time
        // e.g. isTheTimeOk($time);
        $this->fecha = $time;
        return parent::beforeSave($insert);
    }
}
