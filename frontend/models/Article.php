<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $author
 * @property string $source
 * @property string $source_url
 * @property string $source_date
 * @property string $source_bio
 * @property string $body
 * @property string $teaser
 * @property int $uid
 * @property int $status
 * @property int $created
 *
 * @property Category $category
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id', 'uid', 'status', 'created'], 'integer'],
            [['source_bio', 'body', 'teaser'], 'string'],
            [['title', 'author', 'source', 'source_url'], 'string', 'max' => 255],
            [['source_date'], 'string', 'max' => 50],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public static function getMainArticle($demo = false)
    {
        return Article::findOne(['id' => 101]);
    }

    public static function getFrontPageArticles()
    {
        return Article::find()
            ->where(['status' => 1])
            ->limit(10)
            ->orderBy(['created' => SORT_DESC])
            ->all();
    }

    public static function getBreakingNews()
    {
        return Article::find()->where(['category_id' => 55, 'status' => 1])->limit(5)->orderBy(['created' => SORT_DESC])->all();
    }

    public static function getHistoryNews()
    {
        return Article::find()->where(['category_id' => 54, 'status' => 1])->limit(5)->orderBy(['created' => SORT_DESC])->all();
    }


    public static function getArticleByCategory($category_id, $params = array())
    {
        $limit = (isset($params['limit'])) ? $params['limit'] : 20;
        return Article::find()->where(['category_id' => $category_id, 'status' => 1])->limit($limit)->orderBy(['created' => SORT_DESC])->all();
    }

    public static function getTrendingItemData()
    {
        return $trending = Trendingarticle::find()->all();
    }

    public static function getArticleByCategoryGroup($category_group_id, $params = array())
    {
        $query = Article::find()
            ->select('article.*')
            ->joinWith(['category'])
            ->where(['category.group_id' => $category_group_id, 'article.status' => 1])
            ->orderBy(['created' => SORT_DESC])
            ->limit(10);

        if (!empty($params['limit']) && $params['limit'] > 0) {
            $query->limit($params['limit']);
        }

        return $query->all();
    }

    public function getType() {
        return 'article';
    }

    public function purifyBodyAndSource()
    {
        $rxPat = '/<p>(\s|&nbsp;|<\/?\s?br\s?\/?>)*<\/?p>/';
        $purifier = new CHtmlPurifier();
        $purifier->options = Yii::app()->params['htmlPurifierOptions'];

        $this->body = $purifier->purify($this->body);
        $this->body = preg_replace($rxPat, '', $this->body);

        $this->source_bio = $purifier->purify($this->source_bio);
        $this->source_bio = preg_replace($rxPat, '', $this->source_bio);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'author' => 'Author',
            'source' => 'Source',
            'source_url' => 'Source Url',
            'source_date' => 'Source Date',
            'source_bio' => 'Source Bio',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getTags()
    {
        $tags = [];
        $result = NodeTagXref::find()
            ->where(['type' => 'article', 'nid' => $this->id])
            ->all();
        if(!empty($result)) {
            foreach ($result as $ntx) {
                $tags[$ntx->tag->id] = $ntx->tag;
            }
        }
        return $tags;
    }

}
