<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property int $category_id
 * @property int $author_id
 * @property string $title
 * @property string $source
 * @property string $body
 * @property string $teaser
 * @property int $uid
 * @property int $status
 * @property int $created
 *
 * @property BlogAuthor $author
 * @property Category $category
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'author_id', 'uid', 'status', 'created'], 'integer'],
            [['body', 'teaser'], 'string'],
            [['title', 'source'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogAuthor::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'author_id' => 'Author ID',
            'title' => 'Title',
            'source' => 'Source',
            'body' => 'Body',
            'teaser' => 'Teaser',
            'uid' => 'Uid',
            'status' => 'Status',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(BlogAuthor::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
