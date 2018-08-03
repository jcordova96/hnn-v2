<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $nid
 * @property int $user_id
 * @property string $name
 * @property string $subject
 * @property string $comment
 * @property int $timestamp
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nid', 'user_id', 'timestamp'], 'integer'],
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 60],
            [['subject'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nid' => 'Nid',
            'user_id' => 'User ID',
            'name' => 'Name',
            'subject' => 'Subject',
            'comment' => 'Comment',
            'timestamp' => 'Timestamp',
        ];
    }
}
