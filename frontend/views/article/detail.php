<?php
/* @var $this ArticleController */

//Yii::app()->clientScript->registerLinkTag('amphtml', null, 'https://b.marfeel.com/amp/historynewsnetwork.org/article/' . $data['article']->id);
//Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/hnn/bodycopy.css');
//Yii::app()->clientScript->registerScript('pwrapper', '$(\'div#bodycopy\').contents().filter(function() { return this.nodeType === 3 && $.trim(this.textContent).length }).wrap(\'</p>\');');

if (!empty($data['article']->teaser))
{
    $teaser = substr(strip_tags($data['article']->teaser), 0, 160);
    $elipsesSuffix = (strlen(strip_tags($data['article']->teaser)) > 160) ? " ...":"";
//    Yii::app()->clientScript->registerMetaTag($teaser.$elipsesSuffix, 'description');
}
?>
<?php $category = $data['article']->category ?>

<?php if (!empty($data['article']->source)): ?>
    <span class="article-info">
		<a href="<?php if (!empty($data['article']->source_url)) echo $data['article']->source_url; ?>"
           target="_blank">
            SOURCE: <?php echo $data['article']->source; ?>
        </a>
	</span>
    <br/>
<?php endif; ?>
<?php if (!empty($data['article']->source_date)): ?>
    <span class="article-info">
		<?php echo $data['article']->source_date; ?>
	</span><br/>
<?php else: ?>
    <span class="article-info">
        <?php //echo date("n-j-y", $data['article']->created); ?>
    </span>
    <br/>
<?php endif; ?>

    <h1 class="no-uc"><?php echo $data['article']->title; ?></h1>

<?php if (isset($category)): ?>
    <a style="color:#777;" href='/article/category/<?php echo $category->id; ?>'>
        <?php echo $category->name; ?>
    </a><br/>
<?php endif; ?>

<?php $tags = $data['article']->getTags(); ?>
<?php if (!empty($tags)): ?>
    tags:
    <?php end($tags);
    $last_key = key($tags);
    reset($tags); ?>
    <?php foreach ($tags as $tag): ?>
        <a href="/tag/<?php echo $tag->id; ?>"
           target="_blank"><?php echo $tag->name; ?></a><?php if ($tag->id != $last_key): ?>,<?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
    <br/>
    <br/>

    <div class="sharethis-inline-share-buttons"></div>
    <br/>
    <br/>

<?php if (!empty($data['article']->author)): ?>
    <span class="byline">by <?php echo $data['article']->author ?></span>
<?php endif; ?>
<?php if (!empty($data['article']->source_bio)): ?>
    <p id="author-bio"><?php echo $data['article']->source_bio ?></p>
<?php endif; ?>

<?php if (!empty($data['article']->lead_text)): ?>
    <p class="lead">
        <?php echo $data['article']->lead_text; ?>
    </p>
<?php endif; ?>

    <div id="bodycopy">
        <?php echo $data['article']->body; ?>
    </div>

<?php if (!empty($data['article']->source_url)): ?>
    <a class="btn pull-right mrf-readEntireArticle" href="<?= $data['article']->source_url; ?>" target="_blank">
        Read entire article at <strong><?= $data['article']->source; ?></strong>
    </a>
    <br/>
<?php endif; ?>

    <hr/>

    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'hnndev'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function () {
            var dsq = document.createElement('script');
            dsq.type = 'text/javascript';
            dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="//disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
    <a href="//disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

<?php if (!empty($data['legacy_comments'])): ?>
    <hr/>
    <h2>More Comments:</h2>
    <?php foreach ($data['legacy_comments'] as $comment): ?>
        <hr/>
        <div>
            <h3>
                <?php echo $comment->name; ?> -
                <?php echo date('n/j/Y', $comment->timestamp); ?>
            </h3>

            <p><?php echo $comment->comment; ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>