<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hnn_ad".
 *
 * @property int $id
 * @property string $slot
 * @property string $ad_code
 * @property string $modified
 */
class HnnAd extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hnn_ad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ad_code'], 'string'],
            [['modified'], 'safe'],
            [['slot'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slot' => 'Slot',
            'ad_code' => 'Ad Code',
            'modified' => 'Modified',
        ];
    }
}
