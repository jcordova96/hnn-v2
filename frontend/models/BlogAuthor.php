<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "blog_author".
 *
 * @property int $id
 * @property int $uid
 * @property string $author
 * @property string $description
 * @property int $active
 *
 * @property Blog[] $blogs
 */
class BlogAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'active'], 'integer'],
            [['description'], 'string'],
            [['author'], 'string', 'max' => 255],
        ];
    }

    public static function getAuthors($mode = 'active')
    {
        $query = BlogAuthor::find();
        $where = [];
        if ($mode == 'inactive') {
            $where['active'] = '0';
        }
        elseif ($mode == 'all') {
        }
        else {
            $where['active'] = '1';
        }
        $result = $query->where($where)
            ->all();
        if (!empty($result))
        {
            foreach ($result as $row)
            {
                $data[$row->id] = $row->author;
            }
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'author' => 'Author',
            'description' => 'Description',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['author_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}
