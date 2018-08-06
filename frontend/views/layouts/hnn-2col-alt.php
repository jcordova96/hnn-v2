<?php

/* @var $this Controller */

use app\models\Article;
use app\models\HnnAd;

?>
<?php $this->beginContent('@app/views/layouts/hnn-main-1.php'); ?>

    <!-- Center column -->
    <div id="center-column" class="span9">

        <?php echo $content; ?>

    </div>

    <!-- Right column -->
    <div id="right-column" class="span3 center-content">

        <!-- News widget begin -->
        <div id="news-widget" class="tabbable">
            <h1 class="invert">News</h1>
            <ul class="nav nav-tabs nav-stacked hidden-desktop">
                <li class="active"><a href="#breaking-news-tab" data-toggle="tab">Breaking News</a></li>
                <li><a href="#history-news-tab" data-toggle="tab">Historians</a></li>
                <li><a href="//feeds.feedburner.com/historycoalition" target="_blank">DC</a></li>
            </ul>
            <ul class="nav nav-tabs visible-desktop">
                <li class="active"><a href="#breaking-news-tab" data-toggle="tab">Breaking News</a></li>
                <li><a href="#history-news-tab" data-toggle="tab">Historians</a></li>
                <li><a href="//feeds.feedburner.com/historycoalition" target="_blank">DC</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="breaking-news-tab">
                    <ul>
                        <?php foreach (Article::getBreakingNews() as $article): ?>
                            <li>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['article/' . $article->id]); ?>">
                                    <?php echo $article->title; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="tab-pane" id="history-news-tab">
                    <ul>
                        <?php foreach (Article::getHistoryNews() as $article): ?>
                            <li>
                                <a href="<?php echo Yii::$app->urlManager->createUrl(['article/' . $article->id]); ?>">
                                    <?php echo $article->title; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- News widget end -->

        <!-- Trending widget begin -->
        <?php $trendingItemData = Article::getTrendingItemData() ?>
        <?php if(!empty($trendingItemData)): ?>
            <div id="trending-widget" class="tabbable">
                <h1 class="invert">Trending Now</h1>
                <ul class="nav nav-tabs nav-stacked hidden-desktop">
                    <li class="active"><a href="#trending-news-tab" data-toggle="tab">Trending on HNN</a></li>
                </ul>
                <ul class="nav nav-tabs visible-desktop">
                    <li class="active"><a href="#trending-news-tab" data-toggle="tab">Trending on HNN</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="trending-news-tab">
                        <ul>
                            <?php foreach ($trendingItemData as $item): ?>
                                <li>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl([$item->type.'/' . $item->item->id]); ?>">
                                        <?php echo $item->item->title; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <!-- Trending widget end -->

        <!-- Right sidebar ads begin -->
        <?php $ads = HnnAd::getAdsHtml('right_sidebar'); ?>
        <?= $ads ?>
        <!-- Right sidebar ads end -->

    </div>

<?php $this->endContent(); ?>