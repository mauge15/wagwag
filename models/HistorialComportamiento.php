<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "HISTCOMPORTAMIENTO".
 *
 * @property integer $id
 * @property integer $id_mascota
 * @property string $ha_mordido
 * @property string $ha_sido_mordido
 * @property string $miedo_perro
 * @property integer $id_temperamento
 * @property string $juega_perros
 * @property string $juega_personas
 * @property string $persona_desconocida
 * @property string $otra_info
 * @property string $encuentro_perro
 * @property string $miedos
 * @property string $protege_cosas
 * @property string $gusta_jugar
 */
class HistorialComportamiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'HISTCOMPORTAMIENTO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mascota', 'id_temperamento'], 'integer'],
            [['juega_perros', 'juega_personas','ha_mordido','ha_sido_mordido','miedo_perro','encuentro_perro','miedos','protege_cosas','gusta_jugar'], 'string', 'max' => 150],
            [['persona_desconocida', 'otra_info'], 'string', 'max' => 200],
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
            'ha_mordido' => '¿Ha Mordido alguna vez?',
            'ha_sido_mordido' => '¿Le han mordido alguna vez?',
            'miedo_perro' => '¿Tiene miedo desde entonces a algun perro?',
            'id_temperamento' => 'Califica a su perro como:',
            'juega_perros' => 'Cuando juega con otros perros',
            'juega_personas' => 'Cuando juega con otras personas',
            'persona_desconocida' => 'Se encuentra con otra persona desconocida',
            'encuentro_perro' => 'Se encuentra con otro perro',
            'miedos' => 'Miedos/Fobias',
            'protege_cosas' => '¿Protege tu perro los juguetes o la comida?',
            'gusta_jugar' => '¿A tu perro le gusta jugar con otros cuando sale al parque?',
            'otra_info' => 'Otra información sobre su conducta',
        ];
    }
}
