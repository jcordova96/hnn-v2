<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "trendingarticle".
 *
 * @property int $id
 * @property int $itemId
 * @property int $rank
 * @property string $type
 */
class Trendingarticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'trendingarticle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itemId', 'rank', 'type'], 'required'],
            [['itemId', 'rank'], 'integer'],
            [['type'], 'string', 'max' => 255],
            [['itemId'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'itemId' => 'Item ID',
            'rank' => 'Rank',
            'type' => 'Type',
        ];
    }
}
