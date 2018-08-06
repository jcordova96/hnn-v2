<?php
/* @var $this ArticleController */

use yii\widgets\LinkPager;
use app\models\File;

//echo "<pre>" . print_r($data, true) . "</pre>";


//$this->pageTitle = Yii::app()->name;
?>

<?php if (!empty($data['blog_entries'][0])): ?>
	<h1 class="invert"><?php echo $data['blog_entries'][0]['author']->author; ?>
        <a class="rss pull-right" href="<?php echo Yii::$app->request->getUrl(); ?>/rss.xml">
            <img src="<?php echo Yii::$app->request->getBaseUrl(); ?>/images/icon/rss.png">
        </a>
    </h1>
<?php endif; ?>

<p><?php echo $data['author']->description; ?></p>

<div class="" dir="ltr">
    <div><?php echo LinkPager::widget(['pagination' => $pagination,]); ?></div>
</div>
<hr />


<?php //var_dump($data['blog_entries']) ?>


<?php foreach ($data['blog_entries'] as $i => $blog_data): ?>
    <?php $tnImg = File::getTnImage($blog_data['id'], 'blog') ?>
    <ul class="thumbnails">

		<li class="span6">
            <?php if(!empty($tnImg)): ?>
            <div class="blogpost-image">
                <a href="/blog/<?php echo $blog_data['id']; ?>">
                    <img src="<?= $tnImg ?>"alt="">
                </a>
            </div>
            <?php endif; ?>
			<span class="article-info">
				<?php echo date("M j, Y g:i a", $blog_data['created']); ?>
			</span>
			<br />
			<?php if (!empty($blog_data['tags'])): ?>
				tags:
				<?php end($blog_data['tags']); $last_key = key($blog_data['tags']); reset($blog_data['tags']); ?>
				<?php foreach ($blog_data['tags'] as $tag_id => $tag): ?>
					<a href="/tag/<?php echo $tag_id; ?>"><?php echo $tag; ?></a><?php if ($tag_id != $last_key): ?>,<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>

			<h3>
				<a href="/blog/<?php echo $blog_data['id']; ?>">
					<?php echo $blog_data['title']; ?>
				</a>
			</h3>

			<?php if (!empty($blog_data['first_name'])): ?>
				<h4>
					by <?php echo $blog_data['first_name'] ?>
					<?php echo $blog_data['middle_name'] ?>
					<?php echo $blog_data['last_name'] ?>
				</h4>
			<?php endif; ?>

			<div class="blog-teaser"><?php echo $blog_data['teaser']; ?></div>

            <a class="pull-right" href="<?php echo Yii::$app->urlManager->createUrl($blog_data['id'].'#blog-comment'); ?>">
                <img src="<?php echo Yii::$app->request->getBaseUrl(); ?>/images/icon/blog-comments.jpg" />
            </a>

		</li>
	</ul>

	<div class="article-divider"></div>
<?php endforeach; ?>

<div class="" dir="ltr">
    <div><?php echo LinkPager::widget(['pagination' => $pagination,]); ?></div>
</div>
