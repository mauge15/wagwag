<?php

namespace app\models;

use Yii;

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
            [['id_mascota', 'id_bono', 'id_propietario', 'fecha_compra', 'fecha_caducidad', 'dias_utilizados', 'dias_bono'], 'required'],
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
            'id_bono' => 'Id Bono',
            'id_propietario' => 'Id Propietario',
            'fecha_compra' => 'Fecha Compra',
            'fecha_caducidad' => 'Fecha Caducidad',
            'dias_utilizados' => 'Dias Utilizados',
            'dias_bono' => 'Dias Bono',
        ];
    }
}
