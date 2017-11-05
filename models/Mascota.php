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
            [['nombre', 'fecha_nac', 'chip', 'id_raza', 'sexo', 'esterilizado', 'fecha_ult_celo', 'adoptado', 'id_protectora', 'id_historial_medico', 'id_historial_comportamiento'], 'required'],
            [['fecha_nac', 'fecha_ult_celo'], 'safe'],
            [['chip', 'id_raza', 'esterilizado', 'adoptado', 'id_protectora', 'id_historial_medico', 'id_historial_comportamiento'], 'integer'],
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
            'fecha_nac' => 'Fecha Nac',
            'chip' => 'Chip',
            'id_raza' => 'Id Raza',
            'sexo' => 'Sexo',
            'esterilizado' => 'Esterilizado',
            'fecha_ult_celo' => 'Fecha Ult Celo',
            'adoptado' => 'Adoptado',
            'id_protectora' => 'Id Protectora',
            'id_historial_medico' => 'Id Historial Medico',
            'id_historial_comportamiento' => 'Id Historial Comportamiento',
        ];
    }
}
