<?php

namespace app\models;
use app\models\Vacuna;

use Yii;

/**
 * This is the model class for table "vacuna_mascota".
 *
 * @property integer $id
 * @property integer $id_mascota
 * @property integer $id_vacuna
 * @property string $fecha
 * @property string $proxima_fecha
 */
class VacunaMascota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacuna_mascota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mascota', 'id_vacuna', 'fecha'], 'required'],
            [['id_mascota', 'id_vacuna'], 'integer'],
            [['fecha','proxima_fecha'], 'safe'],
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
            'id_vacuna' => 'Id Vacuna',
            'fecha' => 'Fecha',
            'proxima_fecha' => 'Próxima fecha'
        ];
    }

    public function beforeSave($insert) {
        // unix timestamp
        //$time = strtotime($this->fecha_nac);

        // if you want a specific format
        $time = date("Y-m-d", strtotime($this->fecha));
        $vacuna = Vacuna::find()->where(['id' => $this->id_vacuna])->one();
        $nueva_fecha_vto = $time;


        $meses = $vacuna->duracion_mes;

        //anadimos el nº de meses de la vacuna para la fecha de vencimiento
        $fecha_inicial = date("Y-m-d", strtotime($this->fecha));
        $fecha_final = strtotime(date("Y-m-d", strtotime($fecha_inicial)) . " +". $meses."month");
        $date = date("Y-m-d",$fecha_final);

        
        //$date_vencimiento = strtotime($this->fecha . " +". $meses." month");
        //$nueva_fecha_vto = date("Y-m-d",strtotime($date_vencimiento));
        $this->proxima_fecha = $date;




        // any other custom validations you need for your date time
        // e.g. isTheTimeOk($time);
        $this->fecha = $time;
        return parent::beforeSave($insert);
    }
}
