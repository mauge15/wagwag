<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "FACTURA".
 *
 * @property integer $id
 * @property integer $id_mascota
 * @property integer $id_propietario
 * @property integer $id_bono
 * @property double $total
 * @property integer $descuento
 * @property double $monto_descuento
 */
class Factura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'factura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_mascota', 'id_propietario', 'id_bono', 'total', 'descuento', 'monto_descuento'], 'required'],
            [['id_mascota', 'id_propietario', 'id_bono', 'descuento'], 'integer'],
            [['total', 'monto_descuento'], 'number'],
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
            'id_propietario' => 'Id Propietario',
            'id_bono' => 'Id Bono',
            'total' => 'Total',
            'descuento' => 'Descuento',
            'monto_descuento' => 'Monto Descuento',
        ];
    }
}
