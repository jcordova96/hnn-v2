<?php

use yii\db\Migration;

/**
 * Class m180802_221710_hnn_db_init
 */
class m180802_221710_hnn_db_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_group', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);

        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer(11)->notNull(),
            'name' => $this->string(255),
            'description' => $this->text(),
            'weight' => $this->tinyInteger(4)->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey('fk-category-group', 'category', 'group_id', 'category_group', 'id', 'no action');

        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull(),
            'title' => $this->string(255),
            'author' => $this->string(255),
            'source' => $this->string(255),
            'source_url' => $this->string(255),
            'source_date' => $this->string(50),
            'source_bio' => $this->text(),
            'body' => $this->text(),
            'teaser' => $this->text(),
            'uid' => $this->integer(11)->notNull()->defaultValue(0),
            'status' => $this->integer(11)->notNull()->defaultValue(1),
            'created' => $this->integer(11)->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey('fk-article-category', 'article', 'category_id', 'category', 'id', 'no action');

        $this->createTable('blog_author', [
            'id' => $this->primaryKey(),
            'uid' => $this->integer(11)->notNull()->defaultValue(0),
            'author' => $this->string(255),
            'description' => $this->text(),
            'active' => $this->tinyInteger(1)->notNull()->defaultValue(1),
        ]);

        $this->createTable('blog', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull(),
            'author_id' => $this->integer(11),
            'title' => $this->string(255),
            'source' => $this->string(255),
            'body' => $this->text(),
            'teaser' => $this->text(),
            'uid' => $this->integer(11)->notNull()->defaultValue(0),
            'status' => $this->integer(11)->notNull()->defaultValue(1),
            'created' => $this->integer(11)->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey('fk-blog-category', 'blog', 'category_id', 'category', 'id', 'no action');
        $this->addForeignKey('fk-blog-blog_author', 'blog', 'author_id', 'blog_author', 'id', 'no action');

        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'nid' => $this->integer(11)->notNull()->defaultValue(0),
            'user_id' => $this->integer(11)->notNull()->defaultValue(0),
            'name' => $this->string(60),
            'subject' => $this->string(64),
            'comment' => $this->text(),
            'timestamp' => $this->integer(11)->notNull()->defaultValue(0),
        ]);

        $this->createTable('country', [
            'ixCountry' => $this->primaryKey(),
            'sName' => $this->string(80)->notNull(),
            'sFormattedName' => $this->string(80)->notNull(),
            'ixCountry2' => $this->char(3),
            'sIsoNumCode' => $this->smallInteger(6)->defaultValue(null),
            'sRegion' => $this->string(100)->defaultValue(null),
        ]);

        $this->createTable('file', [
            'id' => $this->primaryKey(),
            'nid' => $this->integer(11)->notNull()->defaultValue(0),
            'filename' => $this->string(255)->notNull()->defaultValue(''),
            'filepath' => $this->string(255)->notNull()->defaultValue(''),
            'filemime' => $this->string(255)->notNull()->defaultValue(''),
            'filesize' => $this->integer(10)->notNull()->defaultValue(0),
            'type' => $this->string(32)->notNull()->defaultValue(''),
            'timestamp' => $this->integer(11)->notNull()->defaultValue(0),
        ]);

        $this->createTable('hnn_ad', [
            'id' => $this->primaryKey(),
            'slot' => $this->string(100)->defaultValue(null),
            'ad_code' => $this->text(),
            'modified' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createTable('jobpost', [
            'ixJobPost' => $this->primaryKey(),
            'user_id' => $this->integer(11)->defaultValue(null),
            'sSource' => $this->string(50)->defaultValue(null),
            'sLocation' => $this->string(255)->defaultValue(null),
            'sGeneralStartDate' => $this->string(255)->defaultValue(null),
            'sSalaryDescription' => $this->text(),
            'sRequirements' => $this->text(),
            'sBenefits' => $this->string(255)->defaultValue(null),
            'sDescription' => $this->text(),
            'sTitle' => $this->string(255)->defaultValue(null),
            'sEmployerName' => $this->string(255)->defaultValue(null),
            'sContactEmail' => $this->string(100)->defaultValue(null),
            'sUrl' => $this->string(255)->defaultValue(null),
            'sUrlExternal' => $this->string(255)->defaultValue(null),
            'sApplicationUrl' => $this->string(255)->defaultValue(null),
            'dtPosted' => $this->dateTime()->notNull(),
            'dtExpire' => $this->dateTime()->notNull(),
            'sAddress' => $this->string(255)->defaultValue(null),
            'sStateProvince' => $this->string(100)->defaultValue(null),
            'sCity' => $this->string(100)->defaultValue(null),
            'ixCountry' => $this->char(2)->defaultValue(null),
            'fVerified' => $this->tinyInteger(1)->defaultValue(null),
            'fActive' => $this->tinyInteger(1)->defaultValue(null),
        ]);

        $this->createTable('node_tag_xref', [
            'nid' => $this->integer(11)->notNull(),
            'tag_id' => $this->integer(11)->notNull(),
            'type' => $this->string(60),
        ]);

        $this->createIndex('node_tag_index', 'node_tag_xref', ['nid', 'tag_id'], true);

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
        ]);

        $this->createTable('trendingarticle', [
            'id' => $this->primaryKey(),
            'itemId' => $this->integer(11)->notNull(),
            'rank' => $this->integer(11)->notNull(),
            'type' => $this->string(255)->notNull(),
        ]);

        $this->createIndex('trendingArticle_articleId_uindex', 'trendingarticle', 'itemId', true);

        $this->createTable('static_page', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),
            'modified' => $this->integer(11)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('trendingArticle_articleId_uindex', 'trendingarticle');
        $this->dropIndex('node_tag_index', 'node_tag_xref');

        $this->dropForeignKey('fk-blog-category', 'blog');
        $this->dropForeignKey('fk-blog-blog_author', 'blog');
        $this->dropForeignKey('fk-article-category', 'article');
        $this->dropForeignKey('fk-category-group', 'category');

        $this->dropTable('static_page');
        $this->dropTable('trendingarticle');
        $this->dropTable('tag');
        $this->dropTable('node_tag_xref');
        $this->dropTable('jobpost');
        $this->dropTable('hnn_ad');
        $this->dropTable('file');
        $this->dropTable('country');
        $this->dropTable('comment');
        $this->dropTable('blog');
        $this->dropTable('blog_author');
        $this->dropTable('article');
        $this->dropTable('category');
        $this->dropTable('category_group');
    }

}
