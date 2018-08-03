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

//       $connection = Yii::app()->db;
//
//       $data = [];
//       $itemFound = false;
//
//       $sql = "select ids from node_set where set_id = 'homepage';";
//       $command = $connection->createCommand($sql);
//       $result = $command->queryAll();
//       $item_ids = trim($result[0]["ids"], ' \t.,');
//       $item_ids_arr = explode(',', $item_ids);
//
//       $item = null;
//       $type = null;
//
//       foreach ($item_ids_arr as $i => $v) {
//           $v = trim($item_ids_arr[$i]);
//
//           if (!isset($v[0])) {
//               continue;
//           }
//
//           if ($v[0] == 'm') {
//               $v = substr($v, 1, strlen($v) - 1);
//
//               if ($v[0] == 'a') {
//                   $type = "article";
//                   $article_id = substr($v, 1, strlen($v) - 1);
//
//                   $item = Article::model()->find('id=:id', array(':id' => $article_id));
//               } else {
//                   if ($v[0] == 'b') {
//                       $type = "blog";
//                       $blog_id = substr($v, 1, strlen($v) - 1);
//                       $item = Blog::model()->find('id=:id', array(':id' => $blog_id));
//                   } else {
//                       if (is_numeric($v)) {
//                           $type = "article";
//                           $article_id = $v;
//                           $item = Article::model()->find('id=:id', array(':id' => $article_id));
//                       }
//                   }
//               }
//
//               if (!empty($item)) {
//                   $itemFound = true;
//                   if (!$demo) {
//                       break;
//                   }
//               }
//           }
//       }
//       if ($itemFound) {
//           $author = "";
//           if ($type == 'blog') {
//               $blog_author = BlogAuthor::model()->find('id=:id', array(':id' => $item->author_id));
//               $author = $blog_author->author;
//           } else {
//               $author = $item->author;
//           }
//
//           if (!empty($item)) {
//               $data['id'] = $item->id;
//               $data['title'] = $item->title;
//               $data['author'] = $author;
//               $data['path'] = '/' . $type . '/' . $item->id;
//           }
//       }
//       return $data;
    }

    public static function getFrontPageArticles()
    {
        return Article::find()
            ->where(['status' => 1])
            ->limit(10)
            ->orderBy(['created' => SORT_DESC])
            ->all();

//       $connection = Yii::app()->db;
//       $data = array();
//
//       $sql = "select ids from node_set where set_id = 'homepage';";
//       $command = $connection->createCommand($sql);
//       $result = $command->queryAll();
//       $item_ids = trim($result[0]["ids"], ' \t.,');
//       $item_ids_arr = explode(',', $item_ids);
//       $article_ids_arr = array();
//       $blog_ids_arr = array();
//       foreach ($item_ids_arr as $i => $v) {
//           $item_ids_arr[$i] = $v = trim($item_ids_arr[$i]);
//
////           echo $v[0].',';
//
//           if (!isset($v[0])) {
//               continue;
//           }
//
//           if ($v[0] == 'a') {
//               $article_ids_arr[] = substr($v, 1, strlen($v) - 1);
//           } else {
//               if ($v[0] == 'b') {
//                   $blog_ids_arr[] = substr($v, 1, strlen($v) - 1);
//               } else {
//                   if (is_numeric($v)) {
//                       $article_ids_arr[] = $v;
//                   }
//               }
//           }
//       }
//       $article_ids = implode(',', $article_ids_arr);
//       $blog_ids = implode(',', $blog_ids_arr);
//       $item_ids_arr = array_flip($item_ids_arr);
//
//       // initialize array so order will be correct
//       $num_items = count($item_ids_arr);
//       for ($i = 0; $i < $num_items; $i++) {
//           $data[$i] = array();
//       }
//
////       echo '1 - '.$article_ids.' ------ 2 - '.$blog_ids.'<br />';
////       echo print_r($item_ids_arr, true);
//
//       // get article, blog tags
//       $sql = "
//           select ntx.nid, ntx.tag_id, t.name, ntx.type
//           from node_tag_xref ntx
//           left join tag t on t.id = ntx.tag_id
//           where ntx.nid in ({$article_ids})
//           and ntx.type = 'article'
//           ";
//
//       if (!empty($blog_ids)) {
//           $sql .= "
//           union
//
//           select ntx.nid, ntx.tag_id, t.name, ntx.type
//           from node_tag_xref ntx
//           left join tag t on t.id = ntx.tag_id
//           where ntx.nid in ({$blog_ids})
//           and ntx.type = 'blog'
//           ";
//       }
//
//       $command = $connection->createCommand($sql);
//       $result = $command->queryAll();
//       $tag_data = array();
//       if (!empty($result)) {
//           foreach ($result as $row) {
//               $tag_data[$row['type']][$row['nid']][$row['tag_id']] = $row['name'];
//           }
//       }
//       // get article data
//       $sql = "
//           select a.id, a.title, a.body, a.author, a.source, a.source_url, a.teaser, a.source_date, a.created,
//               c.name as category, c.id as category_id, 'article' as type
//           from article a
//           left join category c on c.id = a.category_id
//           where a.id in ({$article_ids});
//           ";
//       $command = $connection->createCommand($sql);
//       $a_result = $command->queryAll();
//
//       if (!empty($blog_ids)) {
//           // get blog data
//           $sql = "
//               select b.id, b.title, b.body, b.author_id, b.source, b.teaser, b.created,
//                   ba.id as author_id, ba.author, 'blog' as type
//               from blog b
//               left join blog_author ba on ba.id = b.author_id
//               where b.id in ({$blog_ids});
//               ";
//           $command = $connection->createCommand($sql);
//           $b_result = $command->queryAll();
//       } else {
//           $b_result = array();
//       }
//
//
//       // fill final data structure
//       $result = array_merge($a_result, $b_result);
//       if (!empty($result)) {
//           foreach ($result as $row) {
//               $type_prefix = ($row['type'] == 'article') ? 'a' : 'b';
//               $row['teaser'] = strip_tags($row['teaser'],
//                   '<p><span><strong><i><s><b><u><a><article><br><br/>'); //allow simple formatting tags
//               $row['tn_img'] = File::getTnImage($row['id'], $row['type']);
//               $row['tags'] = (!empty($tag_data[$row['type']][$row['id']])) ? $tag_data[$row['type']][$row['id']] : array();
////               $data[$row['category']][] = $row;
//
//               // try possible key matches
//               if (isset($item_ids_arr[$type_prefix . $row['id']])) {
//                   $key = $type_prefix . $row['id'];
//               } else {
//                   if (isset($item_ids_arr[$row['id']]) && $type_prefix == 'a') {
//                       $key = $row['id'];
//                   } else {
//                       $key = null;
//                   }
//               }
//
//               if ($key !== null) {
//                   $data[$item_ids_arr[$key]] = $row;
//               }
//           }
//
//           // unset spots with missing data
//           foreach ($item_ids_arr as $i => $v) {
//               if (empty($data[$v])) {
//                   unset($data[$v]);
//               }
//           }
//       }
//
////       echo "<pre>".print_r($data, true)."</pre>";
//
////       if(isset($data['Unpublished Articles']))
////       {
////           $unpublished = $data['Unpublished Articles'];
////           unset($data['Unpublished Articles']);
////           $data['Unpublished Articles'] = $unpublished;
////       }
//
//       return $data;
    }


    public static function getBreakingNews()
    {
        $connection = Yii::app()->db;
        $sql = " 
           select a.id, a.title 
           from article a 
           where a.category_id = 55 
           and a.status = 1 
           order by a.created desc 
           limit 5; 
           ";

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }


    public static function getHistoryNews()
    {
        $connection = Yii::app()->db;
        $sql = " 
           select a.id, a.title 
           from article a 
           where a.category_id = 54 
           and a.status = 1 
           order by a.created desc 
           limit 5; 
           ";

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }


    public static function getArticleByCategory($category_id, $params = array())
    {
        $connection = Yii::app()->db;

        $data = array();

        $sql = " 
           select a.id, a.title, a.body, a.author, a.source, a.teaser, a.source_date, a.created 
           from article a 
           where a.category_id = {$category_id} 
           and a.status = 1 
           order by a.created desc 
           ";

        if (!empty($params['limit']) and $params['limit'] > 0) {
            $sql .= " limit {$params['limit']} ";
        }

        $sql .= ';';

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();

        if (!empty($result)) {
            foreach ($result as $row) {
                $row['teaser'] = strip_tags($row['teaser']);
                $row['tn_img'] = File::getTnImage($row['id'], 'article');
                $data[] = $row;
            }
        }

        return $data;
    }

    public static function getTrendingItemData()
    {
        $connection = Yii::app()->db;

        $sql = "(select a.id, a.title, ta.type, ta.rank 
from article a 
  inner join trendingarticle ta on ta.itemId = a.id 
where a.status = 1 
      and ta.type = 'article') 
union 
(select b.id, b.title, ta.type, ta.rank 
from blog b 
inner join trendingarticle ta on ta.itemId = b.id 
where b.status = 1 
and ta.type = 'blog') 
order by rank";

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }

    public static function getArticleByCategoryGroup($category_group_id, $params = array())
    {
        $connection = Yii::app()->db;

        $data = array();

        $sql = " 
           select a.id, a.title, a.body, a.author, a.source, a.teaser, a.source_date, a.created, 
               a.category_id, c.name as category 
           from article a 
           left join category c on a.category_id = c.id 
           where c.group_id = {$category_group_id} 
           and a.status = 1 
           order by a.created desc 
           ";

        if (!empty($params['limit']) and $params['limit'] > 0) {
            $sql .= " limit {$params['limit']} ";
        }

        $sql .= ';';

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();

        if (!empty($result)) {
            foreach ($result as $row) {
                $row['teaser'] = strip_tags($row['teaser']);
                $row['tn_img'] = File::getTnImage($row['id'], 'article');
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getType() {
        return 'article';
    }


    /*
     * @return void
     * */
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
}
