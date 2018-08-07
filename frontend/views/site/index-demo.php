<?php
/**
 * User: juddbundy dataskills@gmail.com
 * Date: 8/28/15
 * Time: 9:37 AM
 */

/* @var $this SiteController */
//echo "<pre>" . print_r($data['recent_articles'], true) . "</pre>";

$this->pageTitle = Yii::$app->name;
Yii::$app->clientScript->registerScriptFile(Yii::$app->request->baseUrl . '/js/tile-normalize.js', CClientScript::POS_END);
$mainArticleId = (isset($data['recent_articles']['mainArticleId'])) ? $data['recent_articles']['mainArticleId'] : null;
if(isset($data['recent_articles']['mainArticleId']))
{
    unset($data['recent_articles']['mainArticleId']);
}
?>

<?php if(!empty($data['main_article'])): ?>
<!-- main begin -->
<div id="myCarousel" class="carousel slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner">
        <div class="item active">
            <a href="<?php echo $data['main_article']['path'] ?>">
            <img src="/sites/default/files/maintest.jpg" alt="<?php echo $data['main_article']['title']; ?> article image">
                </a>
            <div class="carousel-caption">
                <a href="<?php echo $data['main_article']['path']; ?>">
                <h1 style="font-size: 34px;color: white;margin-top: 10px;line-height:0.9em;"><?php echo $data['main_article']['title']; ?></h1>
                    </a>
                <p>By <?php echo $data['main_article']['author'] ?></p>
            </div>
        </div>
    </div>
</div>
<!-- main end -->
<?php endif; ?>

<h1 class="invert">The Latest <a class="rss pull-right" href="rss.xml"><img
            src="<?php echo Yii::$app->request->baseUrl; ?>/images/icon/rss.png"></a></h1>

<ul class="thumbnails">
    <?php $count=0; foreach ($data['recent_articles'] as $i => $article_data): ?>
        <?php /* main article will be show above, not here in normal list */ if($article_data['id'] == $mainArticleId): continue; ?><?php endif; ?>
        <?php if (!empty($article_data)): ?>
            <li class="span3 news-tile">
                <div class="thumbnail" style="border:none;box-shadow: none;">
                    <!-- info begin -->
                    <div class="info-line sm-margin" style="margin: 2px 0px 8px 37px;">
                        <?php if (!empty($article_data['source'])): ?>
                            <span class="article-info">
                                <a href="<?php if (!empty($article_data['source_url'])) echo $article_data['source_url']; ?>"
                                   target="_blank">
                                    <?php echo $article_data['source']; ?>
                                </a>
                            </span><br/>
                        <?php endif; ?>

                        <?php if (0): ?>
                            <?php if (!empty($article_data['source_date'])): ?>
                                <span class="article-info">
					                <?php echo $article_data['source_date']; ?>
				                </span><br/>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (isset($article_data['category'])): ?>
                            <a style="color:#777;" href='/article/category/<?php echo $article_data['category_id']; ?>'
                               style="display:block;margin:2px;">
                                <span class="label label-info">
                                    <?php echo $article_data['category']; ?>
                                </span>
                            </a><br/>
                            <?php elseif($article_data['type'] == 'blog'): ?>
                                <span class="label label-info">
                                    Blog
                                </span>
                            <br/>
                        <?php endif; ?>

<!--                        <span style="display:block;margin:2px;">-->
<!--                            --><?php //echo date("M j, Y g:i a", $article_data['created']); ?>
<!--                        </span>-->
                    </div>
                    <!-- info end -->
                    <!-- image begin -->
                    <?php if (!empty($article_data['tn_img'])): ?>
                        <div class="tile-pic-container">
                            <a href="/<?php echo $article_data['type']; ?>/<?php echo $article_data['id']; ?>">
                                <img src="<?php echo '/' . $article_data['tn_img']; ?>"
                                     alt="" style="border:1px solid #000;">
                            </a>
                        </div>
                    <?php endif; ?>
                    <!-- image end -->
                    <div class="caption" style="width:190px;margin:0 auto;">
                        <h3><a href="/<?php echo $article_data['type']; ?>/<?php echo $article_data['id']; ?>">
                                <?php echo $article_data['title']; ?>
                            </a>
                        </h3>

                        <?php if (!empty($article_data['author']) && $article_data['type'] == 'article'): ?>
                            <h4><?php echo $article_data['author'] ?></h4>
                        <?php elseif(isset($article_data['author_id'])): ?>
                            <h4>
                                <a href='/blog/author/<?php echo $article_data['author_id']; ?>'>
                                    <?php echo $article_data['author']; ?>
                                </a>
                            </h4>
                        <?php endif; ?>

                        <?php if ($article_data['type'] == "blog"): ?>
                            <div
                                class="blog-teaser"><?php echo Blog::truncateBlogTeaser($article_data['teaser']); ?></div>
                        <?php else: ?>
                            <p class="frontpage"><?php echo $article_data['teaser']; ?></p>
                        <?php endif; ?>


                    </div>
                </div>
            </li>
        <?php endif; ?>
    <?php $count++; endforeach; ?>
</ul>