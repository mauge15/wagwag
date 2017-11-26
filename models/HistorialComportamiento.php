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
            [['id_mascota', 'ha_mordido', 'ha_sido_mordido', 'miedo_perro', 'id_temperamento', 'juega_perros', 'juega_personas', 'persona_desconocida'], 'required'],
            [['id_mascota', 'id_temperamento'], 'integer'],
            [['juega_perros', 'juega_personas','ha_mordido','ha_sido_mordido','miedo_perro'], 'string', 'max' => 150],
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
            'ha_mordido' => 'Ha Mordido',
            'ha_sido_mordido' => 'Ha Sido Mordido',
            'miedo_perro' => 'Tiene miedo a otros perros?',
            'id_temperamento' => 'Temperamento',
            'juega_perros' => 'Juega con otros perros',
            'juega_personas' => 'Juega con otras personas',
            'persona_desconocida' => 'Como reacciona ante una persona desconocida?',
            'otra_info' => 'Otra Información Importante',
        ];
    }
}
