<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "HISTMEDICO".
 *
 * @property integer $id
 * @property string $enf_cardiaca
 * @property string $ale_alimentaria
 * @property string $ale_cutanea
 * @property string $otras_limit
 * @property string $cancer
 * @property string $enf_endocrina
 * @property string $otras
 */
class HistorialMedico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'HISTMEDICO';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['otras_limit'], 'required'],
            [['enf_cardiaca', 'ale_alimentaria', 'ale_cutanea', 'otras_limit', 'cancer', 'enf_endocrina', 'otras'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enf_cardiaca' => 'Enf Cardiaca',
            'ale_alimentaria' => 'Ale Alimentaria',
            'ale_cutanea' => 'Ale Cutanea',
            'otras_limit' => 'Otras Limit',
            'cancer' => 'Cancer',
            'enf_endocrina' => 'Enf Endocrina',
            'otras' => 'Otras',
        ];
    }
}
