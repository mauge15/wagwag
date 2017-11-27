<?php

namespace app\models;

use Yii;
use app\models\Propietario;
use app\models\Mascota;
use app\models\Bono;

/**
 * This is the model class for table "BONO_COMPRADO".
 *
 * @property integer $id
 * @property integer $id_mascota
 * @property integer $id_bono
 * @property integer $id_propietario
 * @property string $fecha_compra
 * @property string $fecha_caducidad
 * @property integer $dias_utilizados
 * @property integer $dias_bono
 */
class BonoComprado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'BONO_COMPRADO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mascota', 'id_bono', 'fecha_compra'], 'required'],
            [['id_mascota', 'id_bono', 'id_propietario', 'dias_utilizados', 'dias_bono'], 'integer'],
            [['fecha_compra', 'fecha_caducidad'], 'safe'],
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
            'id_bono' => 'Tipo de Bono',
            'id_propietario' => 'Id Propietario',
            'fecha_compra' => 'Fecha de Compra',
            'fecha_caducidad' => 'Fecha de Caducidad',
            'dias_utilizados' => 'Dias Utilizados',
            'dias_bono' => 'Dias del Bono',
        ];
    }



    public function beforeSave($insert) {
        // unix timestamp
        // if you want a specific format
        $fecha_compra = date_create_from_format('d/m/Y', $this->fecha_compra);
        $fecha_compra_string = date_format($fecha_compra,'Y-m-d');//String
        $fecha_compra = date("Y-m-d", strtotime($fecha_compra_string));//Es un String
        $this->fecha_compra = $fecha_compra;
        $mascota = Mascota::findOne($this->id_mascota);
        $bono = Bono::findOne($this->id_bono);
        $date=date_create($fecha_compra);
        $interval = new \DateInterval('P'.$bono->caducidad.'M');
        $fecha_caducidad = date_add($date,$interval);
        $fecha_caducidad_string = $fecha_caducidad->format('Y-m-d');
        $this->id_propietario = $mascota->id_propietario;
        $this->fecha_caducidad = $fecha_caducidad_string;
        $this->dias_bono = isset($bono->dias) ? $bono->dias : 0;
        $this->dias_utilizados = 0;
        return parent::beforeSave($insert);
    }
}
