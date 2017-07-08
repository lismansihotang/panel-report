<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "petty_cash".
 *
 * @property integer $id
 * @property string $tgl
 * @property integer $id_kategori
 * @property string $nominal
 * @property string $desc
 */
class PettyCash extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'petty_cash';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tgl', 'id_kategori', 'nominal'], 'required'],
            [['tgl'], 'safe'],
            [['id_kategori'], 'integer'],
            [['nominal'], 'number'],
            [['desc'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tgl' => 'Tgl.',
            'id_kategori' => 'ID Kategori',
            'nominal' => 'Nominal',
            'desc' => 'Keterangan',
        ];
    }

    /**
     * @inheritdoc
     * @return PettyCashQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PettyCashQuery(get_called_class());
    }
}
