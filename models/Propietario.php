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
 * @property integer $id_referencia
 */
class Propietario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'propietario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido','id_referencia'], 'required'],
            [['telefono', 'cod_postal', 'id_referencia'], 'integer'],
            [['nombre'], 'string', 'max' => 20],
            [['apellido'], 'string', 'max' => 30],
            [['dni'], 'string', 'max' => 11],
            [['direccion'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 40],
            [['persona_contacto'], 'string', 'max' => 80],
        ];
    }

  //  public function relations()
//{
//	return array(
//		'como_nos_conocio' => array(self::BELONGS_TO, 'Referencia', 'id_referencia'),
//	);
//}


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellidos',
            'telefono' => 'Telefono',
            'dni' => 'DNI',
            'direccion' => 'Direccion',
            'cod_postal' => 'Código Postal',
            'email' => 'Email',
            'persona_contacto' => 'Persona de Contacto',
            'id_referencia' => 'Como nos conoció?',
        ];
    }
}
