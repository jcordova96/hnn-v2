<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "static_page".
 *
 * @property int $id
 * @property string $slug
 * @property string $content
 * @property int $modified
 */
class StaticPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'static_page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['slug', 'content'], 'required'],
            [['content'], 'string'],
            [['modified'], 'integer'],
            [['slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'content' => 'Content',
            'modified' => 'Modified',
        ];
    }
}
