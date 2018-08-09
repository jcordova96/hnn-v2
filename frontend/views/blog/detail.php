<?php
/* @var $this BlogController */
use app\models\Blog;

//Yii::$app->clientScript->registerCssFile(Yii::$app->request->getBaseUrl() . '/css/hnn/bodycopy.css');
$this->title = $data['blog']->title;
if (!empty($data['blog']->teaser))
{
    $teaser = substr(strip_tags($data['blog']->teaser), 0, 160);
    $elipsesSuffix = (strlen(strip_tags($data['blog']->teaser)) > 160) ? " ...":"";
//    Yii::$app->clientScript->registerMetaTag($teaser.$elipsesSuffix, 'description');
}
?>

<p>Blogs <span class="breadcrumb-divider">></span> <a
        href="<?php echo Yii::$app->getUrlManager()->createUrl('author/'.$data['blog']->author_id); ?>"><span
            style="text-decoration: underline;"><?php if($data['blog']->author instanceof Blog) echo $data['blog']->author->author; ?></span></a> <span
        class="breadcrumb-divider">></span> <a><?php echo $data['blog']->title; ?></a></p>

<span class="blog-info">

	<?php echo date("M j, Y g:i a", $data['blog']->created); ?>

    <?php if (!empty($data['blog']->author->user->first_name)): ?>
        <br/>
        <span class="byline">
					by <?php echo $data['blog']->author->user->first_name ?>
            <?php echo $data['blog']->author->user->middle_name ?>
            <?php echo $data['blog']->author->user->last_name ?>
		</span>
    <?php endif; ?>
</span>
<br/>
<br/>
<h1><?php echo $data['blog']->title; ?></h1>

<?php if (!empty($data['blog']->tags)): ?>
    tags:
    <?php end($data['blog']->tags);
    $last_key = key($data['blog']->tags);
    reset($data['blog']->tags); ?>
    <?php foreach ($data['blog']->tags as $tag_id => $tag): ?>
        <a href="/tag/<?php echo $tag_id; ?>"><?php echo $tag; ?></a><?php if ($tag_id != $last_key): ?>,<?php endif; ?>
    <?php endforeach; ?>
    <br/>
    <br/>
<?php endif; ?>

<div class="sharethis-inline-share-buttons"></div>
<br/>
<br/>

<?php if (!empty($data['blog']->author)): ?>
    <h4>by <?php echo $data['blog']->author->author ?></h4>
<?php endif; ?>
<?php if (!empty($data['blog']->author_bio)): ?>
    <h5>by <?php echo $data['blog']->author_bio ?></h5>
<?php endif; ?>

<?php if (!empty($data['blog']->lead_text)): ?>
    <p class="lead">
        <?php echo $data['blog']->lead_text; ?>
    </p>
<?php endif; ?>

<div id="bodycopy">
    <?php echo $data['blog']->body; ?>
</div>

<a name="blog-comment"></a>

<br/>

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
<noscript>Please enable JavaScript to view the <a href="//disqus.com/?ref_noscript">comments powered by Disqus.</a>
</noscript>
<a href="//disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>

<?php if (!empty($data['legacy_comments'])): ?>
    <hr/>
    <h2>More Comments:</h2>
    <?php foreach ($data['legacy_comments'] as $comment): ?>
        <hr/>
        <div>
            <h3>
                <?php echo $comment['name']; ?> -
                <?php echo date('n/j/Y', $comment['timestamp']); ?>
            </h3>

            <p><?php echo $comment['comment']; ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
