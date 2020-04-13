<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MASCOTA".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $fecha_nac
 * @property integer $chip
 * @property integer $id_raza
 * @property string $sexo
 * @property integer $esterilizado
 * @property string $fecha_ult_celo
 * @property integer $adoptado
 * @property integer $id_protectora
 * @property integer $id_historial_medico
 * @property integer $id_historial_comportamiento
 * @property integer $nom_vet
 * @property integer $id_propietario
 */
class Mascota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MASCOTA';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //Quitamos en principio id_raza
            [['nombre', 'id_raza','sexo', 'esterilizado'], 'required'],
            [['fecha_nac', 'fecha_ult_celo'], 'safe'],
            [['chip', 'id_raza', 'esterilizado', 'adoptado', 'id_protectora', 'id_historial_medico', 'id_historial_comportamiento','id_veterinario','id_propietario'], 'integer'],
            [['nombre'], 'string', 'max' => 20],
            [['sexo'], 'string', 'max' => 1],
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
            'fecha_nac' => 'Fecha de Nacimiento',
            'chip' => 'Chip',
            'id_raza' => 'Raza',
            'sexo' => 'Sexo',
            'esterilizado' => 'Esterilizado',
            'fecha_ult_celo' => 'Fecha de último celo',
            'adoptado' => 'Adoptado',
            'id_protectora' => 'Asociación Protectora',
            'id_veterinario' => 'Veterinario',
            'id_historial_medico' => 'Id Historial Medico',
            'id_historial_comportamiento' => 'Id Historial Comportamiento',
            'id_propietario' => 'Id Propietario',
            'nom_vet' => 'Nombre del Veterinario',
        ];
    }


    public function beforeSave($insert) {
        // unix timestamp
        //$time = strtotime($this->fecha_nac);

        // if you want a specific format
        $time = date("Y-m-d", strtotime($this->fecha_nac));
        $ult_celo = date("Y-m-d", strtotime($this->fecha_ult_celo));

        // any other custom validations you need for your date time
        // e.g. isTheTimeOk($time);
        $this->fecha_nac = $time;
        $this->fecha_ult_celo = $ult_celo;
        return parent::beforeSave($insert);
    }

     /* ActiveRelation */
    public function getPropietario()
    {
        return $this->hasOne(Propietario::className(), ['id' => 'id_propietario']);
    }


   
}
