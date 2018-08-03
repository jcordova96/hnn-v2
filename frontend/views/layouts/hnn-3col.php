<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/hnn-main-1'); ?>
<?php $blog_authors = BlogAuthor::getAuthors(); ?>

    <!-- Left column -->
    <div id="left-column" class="span3 center-content">

        <div class="hidden-phone">

            <!-- social media links begin -->
            <div class="social-media-button-container">
                <a href="//www.facebook.com/pages/History-News-Network/187220577957886?v=info">
                    <img alt="" src="//historynewsnetwork.org/sites/default/files/68.png" style="height: 32px; width: 32px;">
                </a>
                <a href="https://twitter.com/myHNN">
                    <img alt="" src="//historynewsnetwork.org/sites/default/files/Twitter-icon.png"
                         style="width: 32px; height: 32px;">
                </a>
                <a href="//www.linkedin.com/groups/History-News-Network-4682603/about">
                    <img alt="" src="//historynewsnetwork.org/sites/default/files/linkedin.jpg" style="width: 32px; height: 32px;">
                </a>
            </div>
            <!-- social media links end -->

            <!-- Twitter -->
            <a class="twitter-timeline" href="https://twitter.com/myHNN" data-widget-id="343410152646524928">Tweets by
                @myHNN</a>
            <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + "://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");</script>

            <!-- Blogs -->
            <div id="blog-nav-sidebar">
                <ul class="nav nav-tabs nav-stacked">
                    <h1 class="invert">Blogs</h1>

                    <?php foreach ($blog_authors as $blog_author_id => $blog_author): ?>
                        <li>
                            <a href="/blog/author/<?php echo $blog_author_id; ?>">
                                <?php echo $blog_author; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

    </div>

    <!-- Center column -->
    <div id="center-column" class="span6">

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
                                <a href="<?php echo $this->createUrl('article/' . $article['id']); ?>">
                                    <?php echo $article['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="tab-pane" id="history-news-tab">
                    <ul>
                        <?php foreach (Article::getHistoryNews() as $article): ?>
                            <li>
                                <a href="<?php echo $this->createUrl('article/' . $article['id']); ?>">
                                    <?php echo $article['title']; ?>
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
                                    <a href="<?php echo $this->createUrl($item['type'].'/' . $item['id']); ?>">
                                        <?php echo $item['title']; ?>
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
        <?php $this->widget('AdServe', array('ad_slot' => 'rightSidebarAds')); ?>
        <!-- Right sidebar ads end -->

    </div>

<?php $this->endContent(); ?>