<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/hnn-main-1'); ?>
<?php $blog_authors = BlogAuthor::getAuthors(); ?>

    <!-- Left column -->
    <div id="left-column" class="span3 center-content">

        <div class="hidden-phone">

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
                                    <a href="articles/<?php echo $article['id']; ?>">
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
                                    <a href="articles/<?php echo $article['id']; ?>">
                                        <?php echo $article['title']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <!-- News widget end -->

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

            <!-- Right sidebar ads begin -->
            <?php $this->widget('AdServe', array('ad_slot'=>'rightSidebarAds')); ?>
            <!-- Right sidebar ads end -->

        </div>

    </div>

    <!-- Center column -->
    <div id="center-column" class="span9">

        <?php echo $content; ?>

        <div class="visible-phone">

            <!-- News widget begin -->
            <div id="news-widget" class="tabbable">
                <h1 class="invert">News</h1>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#breaking-news-tab" data-toggle="tab">Breaking News</a></li>
                    <li><a href="#history-news-tab" data-toggle="tab">History News</a></li>
                    <li><a href="//feeds.feedburner.com/historycoalition" target="_blank">DC</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="breaking-news-tab">
                        <ul>
                            <?php foreach (Article::getBreakingNews() as $article): ?>
                                <li>
                                    <a href="<?php echo $this->createUrl('article/'.$article['id']);?>">
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
                                    <a href="<?php echo $this->createUrl('article/'.$article['id']);?>">
                                        <?php echo $article['title']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="divider"></div>
            <!-- News widget end -->

        </div>

    </div>


<?php $this->endContent(); ?>