<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "petty_cash_kategori".
 *
 * @property integer $id
 * @property string $nm_kategori
 */
class PettyCashKategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'petty_cash_kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nm_kategori'], 'required'],
            [['nm_kategori'], 'string', 'max' => 35],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nm_kategori' => 'Nama Kategori',
        ];
    }

    /**
     * @inheritdoc
     * @return PettyCashKategoriQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PettyCashKategoriQuery(get_called_class());
    }
}
