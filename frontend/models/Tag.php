<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    public static function getTagsByNid($nid, $type, $return_arrays = false)
    {
        $connection = Yii::$app->getDb();

        $sql = "
			select ntx.nid, ntx.tag_id, t.name
			from node_tag_xref ntx
			left join tag t on t.id = ntx.tag_id
			where ntx.nid = {$nid}
			and ntx.type = '{$type}'
			and t.name != ''
			";

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();

        $tag_data = array();
        if(!empty($result))
            foreach($result as $row)
                $tag_data[$row['tag_id']] = $row['name'];

        return ($return_arrays === true) ? $tag_data : implode(",", $tag_data);
    }

    public static function setTagsByNid($nid, $tags, $type)
    {
        $tags = explode(',', $tags);
        if(empty($tags))
            return false;

        $connection = Yii::$app->getDb();

        // unset all tags for the given node
        $sql = "delete from node_tag_xref where nid = {$nid} and type = '{$type}';";
        $command = $connection->createCommand($sql);
        $command->execute();

        // match all existing tags from the given tags, if not found create it
        {
            foreach($tags as $tag)
            {
                $tag = trim($tag);

                if($tag != '')
                {
                    $sql = "select * from tag where name = '{$tag}'";
                    $command = $connection->createCommand($sql);
                    $result = $command->queryAll();

                    // if the tag already exists you have the id
                    if(count($result) > 0)
                        $tag_id = $result[0]['id'];
                    // otherwise put it in the db and store the id
                    else
                    {
                        $sql = "insert into tag (name) values ('{$tag}')";
                        $command = $connection->createCommand($sql);
                        $command->execute();
                        $tag_id = Yii::$app->getDb()->lastInsertID;
                    }

                    $sql = "insert into node_tag_xref (nid, tag_id, type) values ('{$nid}', '{$tag_id}', '{$type}')";
                    $command = $connection->createCommand($sql);
                    $command->execute();
                }
            }
        }
    }


    public static function getNodesByTagId($tag_id)
    {
        $connection = Yii::$app->getDb();

        $data = array();

        $sql = "
			select a.id, a.title, a.teaser, a.created, a.author, 'article' as type
			from article a
			left join node_tag_xref ntx on a.id = ntx.nid
			where ntx.tag_id = {$tag_id}
			order by a.created desc
			";

        $command = $connection->createCommand($sql);
        $result = $command->queryAll();

        $sql = "
			select b.id, b.title, b.teaser, b.created, ba.author, 'blog' as type
			from blog b
			left join node_tag_xref ntx on b.id = ntx.nid
			left join blog_author ba on ba.id = b.author_id
			where ntx.tag_id = {$tag_id}
			order by b.created desc
			";

        $command = $connection->createCommand($sql);
        $result2 = $command->queryAll();

        $result = array_merge($result, $result2);

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}
