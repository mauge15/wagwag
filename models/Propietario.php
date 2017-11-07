<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PROPIETARIO".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property integer $telefono
 * @property string $dni
 * @property string $direccion
 * @property integer $cod_postal
 * @property string $email
 * @property string $persona_contacto
 * @property integer $id_Veterinario
 * @property integer $id_referencia
 */
class Propietario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PROPIETARIO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'telefono', 'dni', 'direccion', 'cod_postal', 'email', 'persona_contacto', 'id_Veterinario', 'id_referencia'], 'required'],
            [['telefono', 'cod_postal', 'id_Veterinario', 'id_referencia'], 'integer'],
            [['nombre'], 'string', 'max' => 20],
            [['apellido'], 'string', 'max' => 30],
            [['dni'], 'string', 'max' => 11],
            [['direccion'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 40],
            [['persona_contacto'], 'string', 'max' => 80],
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
            'apellido' => 'Apellido',
            'telefono' => 'Telefono',
            'dni' => 'Dni',
            'direccion' => 'Direccion',
            'cod_postal' => 'Cod Postal',
            'email' => 'Email',
            'persona_contacto' => 'Persona Contacto',
            'id_Veterinario' => 'Id  Veterinario',
            'id_referencia' => 'Id Referencia',
        ];
    }
}
