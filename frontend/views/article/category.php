 <?php
/* @var $this ArticleController */

use app\models\File;

$disclaimer_categories = array(54, 55);
$disclaimer_groups = array(2);
$fShowDisclaimer = false;

if ((isset($data['category_id'])) && (in_array($data['category_id'], $disclaimer_categories)))
    $fShowDisclaimer = true;
elseif ((isset($data['group_id'])) && (in_array($data['group_id'], $disclaimer_groups)))
    $fShowDisclaimer = true;
?>

<h1 class="invert"><?php echo $data['articles'][0]->category->name; ?>
    <a class="rss pull-right"
        href="<?php //echo Yii::app()->request->requestUri; ?>/rss.xml"><img
        src="/images/icon/rss.png"></a></h1>

<?php if ($fShowDisclaimer): ?>
    <p>
        This page features brief excerpts of stories published by the mainstream media and, less frequently, blogs,
        alternative media, and even obviously biased sources. The excerpts are taken directly from the websites cited in
        each source note. Quotation marks are not used.
    </p>
    <hr/>
<?php endif; ?>
 

<?php foreach ($data['articles'] as $article_data): ?>
<?php $tn_img = File::getTnImage($article_data->id, 'article'); ?>
    <ul class="thumbnails">
        <?php if (!empty($tn_img)): ?>
            <li class="span2">
                <div class="thumbnail">
                    <a href="/article/<?php echo $article_data->id; ?>">
                        <img src="<?php echo $tn_img; ?>"
                             alt="">
                    </a>
                </div>
            </li>
        <?php endif; ?>

        <li class="span<?php echo (empty($tn_img)) ? "6" : "4"; /* span variable; maybe image missing */ ?>">

            <?php if (!empty($article_data->source)): ?>
                <span class="article-info">
						SOURCE: <?php echo $article_data->source; ?>
				</span><br/>
            <?php endif; ?>
            <?php if (!empty($article_data->source_date)): ?>
                <span class="article-info">
					<?php echo $article_data->source_date; ?>
				</span><br/>
            <?php endif; ?>
            <!--<span class="article-info">
				<?php echo date("M j, Y g:i a", $article_data->created); ?>
            </span>
			<br />-->
            <?php $tags = $article_data->getTags(); ?>
            <?php if (!empty($tags)): ?>
                tags:
                <?php end($tags);
                $last_key = key($tags);
                reset($tags); ?>
                <?php foreach ($tags as $tag_id => $tag): ?>
                    <a href="/tag/<?php echo $tag->id; ?>"><?php echo $tag->name; ?></a>
                    <?php if ($tag->id != $last_key): ?>,<?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <h3>
                <a href="/article/<?php echo $article_data->id; ?>">
                    <?php echo $article_data->title; ?>
                </a>
            </h3>

            <?php if (!empty($article_data->author)): ?>
                <h4>by <?php echo $article_data->author ?></h4>
            <?php endif; ?>

            <p><?php echo strip_tags($article_data->teaser); ?></p>
        </li>
    </ul>
    <div class="article-divider"></div>
<?php endforeach; ?>
