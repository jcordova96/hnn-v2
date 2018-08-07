<?php
/* @var $this SiteController */
//echo "<pre>" . print_r($data['recent_articles'], true) . "</pre>";

$this->pageTitle = Yii::$app->name;
if(isset($data['recent_articles']['mainArticleId']))
{
    unset($data['recent_articles']['mainArticleId']);
}
?>

<h1 class="invert">The Latest<a class="rss pull-right" href="rss.xml"><img
            src="<?php echo Yii::$app->request->baseUrl; ?>/images/icon/rss.png"></a></h1>

<?php foreach ($data['recent_articles'] as $i => $article_data): ?>
    <?php if (!empty($article_data)): ?>

        <ul class="thumbnails">
            <?php if (!empty($article_data['tn_img'])): ?>
                <li class="span2">
                    <div class="thumbnail">
                        <a href="/<?php echo $article_data['type']; ?>/<?php echo $article_data['id']; ?>">
                            <img src="<?php echo '/' . $article_data['tn_img']; ?>"
                                 alt="">
                        </a>
                    </div>
                </li>
            <?php endif; ?>

            <li class="span<?php echo (empty($article_data['tn_img'])) ? "6" : "4"; /* span variable; maybe image missing */ ?>">
                <?php if (!empty($article_data['source'])): ?>
                    <span class="article-info">
						<a href="<?php if (!empty($article_data['source_url'])) echo $article_data['source_url']; ?>"
                           target="_blank">
                            <?php echo $article_data['source']; ?>
                        </a>
					</span><br/>
                <?php endif; ?>
                <?php if (!empty($article_data['source_date'])): ?>
                    <span class="article-info">
					<?php echo $article_data['source_date']; ?>
				</span><br/>
                <?php endif; ?>
                <!--<span class="article-info">
					<?php echo date("M j, Y g:i a", $article_data['created']); ?>
				</span>
				<br />-->
                <!--
				<?php if (!empty($article_data['tags'])): ?>
					tags:
					<?php end($article_data['tags']); $last_key = key($article_data['tags']); reset($article_data['tags']); ?>
					<?php foreach ($article_data['tags'] as $tag_id => $tag): ?>
						<a href="/tag/<?php echo $tag_id; ?>"><?php echo $tag; ?></a><?php if ($tag_id != $last_key): ?>,<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
				-->
                <?php if (isset($article_data['category'])): ?>
                        <a style="color:#777;" href='/article/category/<?php echo $article_data['category_id']; ?>'>
                            <?php echo $article_data['category']; ?>
                        </a>
                <?php endif; ?>

                <h3>
                    <a href="/<?php echo $article_data['type']; ?>/<?php echo $article_data['id']; ?>">
                        <?php echo $article_data['title']; ?>
                    </a>
                </h3>

                <?php if (!empty($article_data['author']) && $article_data['type'] == 'article'): ?>
                    <h4><?php echo $article_data['author'] ?></h4>
                <?php endif; ?>

                <?php if ($article_data['type'] == "blog"): ?>
                    <div class="blog-teaser"><?php echo Blog::truncateBlogTeaser($article_data['teaser']); ?></div>
                <?php else: ?>
                    <p><?php echo $article_data['teaser']; ?></p>
                <?php endif; ?>

                <?php if (isset($article_data['author_id'])): ?>
                    <h4>
                        <a href='/blog/author/<?php echo $article_data['author_id']; ?>'>
                            <?php echo $article_data['author']; ?>
                        </a>
                    </h4>
                <?php endif; ?>
            </li>
        </ul>
        <div class="article-divider"></div>
    <?php endif; ?>

<?php endforeach; ?>
