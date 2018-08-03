<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "node_tag_xref".
 *
 * @property int $nid
 * @property int $tag_id
 * @property string $type
 */
class NodeTagXref extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'node_tag_xref';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nid', 'tag_id'], 'required'],
            [['nid', 'tag_id'], 'integer'],
            [['type'], 'string', 'max' => 60],
            [['nid', 'tag_id'], 'unique', 'targetAttribute' => ['nid', 'tag_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nid' => 'Nid',
            'tag_id' => 'Tag ID',
            'type' => 'Type',
        ];
    }
}
