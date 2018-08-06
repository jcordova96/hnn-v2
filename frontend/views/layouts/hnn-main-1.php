<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use app\components\Toolshed;
use app\models\BlogAuthor;
use app\models\HnnAd;

$blog_authors = BlogAuthor::getAuthors();
$actionId = \Yii::$app->controller->id.'/'.\Yii::$app->controller->module->requestedAction->id;
$route = \Yii::$app->controller->module->requestedRoute;
//$detect = new Mobile_Detect();
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en" class="no-js"><!--<![endif]-->

<head>
    <script>window.mrf = {host: "b.marfeel.com", dt: 3}, function (e, t, o, i, a, n, r) {
            function s() {
                e.cookie = "fromt=yes;path=/;expires=" + new Date(Date.now() + 18e5).toGMTString(), o.reload()
            }

            if ((/(ipad.*?OS )(?!1_|2_|3_|4_0|4_1|4_2|X)|mozilla.*android (?!(1|2|3)\.)[0-9](?!.*mobile)|\bSilk\b/i.test(i) && 2 & r.dt || /(ip(hone|od).*?OS )(?!1_|2_|3_|4_0|4_1|4_2|X)|mozilla.*android (?!(1|2|3)\.)[0-9].*mobile|bb10/i.test(i) && 1 & r.dt || /marfeelgarda=off/i.test(n)) && !/fromt=yes/i.test(n + ";" + a) && t === t.top) {
                !/marfeelgarda=no/i.test(a) && e.write('<plaintext style="display:none">');
                var d = "script", l = setTimeout(s, 1e4), m = e.createElement(d), c = e.getElementsByTagName(d)[0];
                m.src = "//" + r.host + "/statics/marfeel/gardac.js", m.onerror = s, m.onload = function () {
                    clearTimeout(l)
                }, c.parentNode.insertBefore(m, c)
            }
        }(document, window, location, navigator.userAgent, document.cookie, location.search, window.mrf);</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BEGIN: basic page needs -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="google-site-verification" content="O2EKX9rfWi5pL8NFYqjIexiRCD-sYlv8UKBmB5DM84c"/>
    <title><?php echo isset($this->title) ? Html::encode($this->title) . " | " : ""; ?> History News
        Network</title>
    <!-- END: basic page needs -->

    <link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/style-override.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="/assets/js/head.js"></script>

    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!-- END: js -->

    <!-- sharethis -->
    <script type="text/javascript"
            src="//platform-api.sharethis.com/js/sharethis.js#property=5a0381c02bb39f0012e27bdb&product=inline-share-buttons"></script>

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-55546454-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- Google Search begin -->
    <script>
        (function () {
            var cx = '005019620910017069515:sqpgppnsifi'; // Insert your own Custom Search engine ID here
            var gcse = document.createElement('script');
            gcse.type = 'text/javascript';
            gcse.async = true;
            gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(gcse, s);
        })();
    </script>
    <!-- Google Search end -->
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<!-- .container -->
<section class="container top-gradient">

    <!-- #header .row -->
    <header id="header">
        <div class="row">

            <!-- .span3.logo -->
            <div class="span6 logo">
                <a href="/"><img src="/images/hnn/hnn-logo-march2017-2.jpg"
                                 alt="Logo"/></a>
            </div>
            <!-- /.span3.logo -->

            <!-- .span9 -->
            <nav class="span6">

                <!-- #menu -->
                <ul id="menu" style="position: relative;top: -10px;">
                    <li><a href="#">About Us</a>
                        <ul>
                            <li><a href="/submissions.html">Submissions</a></li>
                            <li><a href="/advertising.html">Advertising</a></li>
                            <li><a href="/donations.html">Donations</a></li>
                            <li><a href="/internships.html">Internships</a></li>
                            <li><a href="/masthead.html">Masthead</a></li>
                            <li><a href="/mission-statement.html">Mission Statement</a></li>
                            <li><a href="/newsletter.html">Newsletter</a></li>
                            <li><a href="/faq.html">FAQ</a></li>
                            <li><a href="/friends-of-hnn.html">Friends of HNN</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- /#menu -->

                <!-- Newsletter signup begin -->
                <?php echo $this->render('/partials/newsletter-inline'); ?>
                <!-- Newsletter signup end -->

            </nav>
            <!-- .span9-->

            <!-- .span3.logo
        <div class="span6 logo">
            <a href="/"><img src="/images/hnn/hnn-logo-new.jpg"
                             alt="Logo"/></a>
        </div>
        -->
    </header>
    <!-- /#header .row -->

    <!-- div.navbar -->
    <div class="navbar">
        <div class="navbar-inner">

            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <span class="brand">Departments</span>

            <div class="nav-collapse">

                <?php
                /*
                $this->widget('zii.widgets.CMenu', array(
                    'encodeLabel' => false,
                    'htmlOptions' => array('class' => 'nav'),
                    'items' => array(
                        array('label' => 'Home', 'url' => Yii::app()->baseUrl),
                        array(
                            'label' => 'News <b class="caret"></b>',
                            'url'=>array('#'),
                            'itemOptions' => array('class' => 'dropdown'),
                            'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>'dropdown'),
                            'submenuOptions'=>array('class'=>'dropdown-menu'),
                            'items'=>array(
                                array('label'=>'Breaking News', 'url'=>'/article/category/55'),
                                array('label'=>'News Archives', 'url'=>'/article/category/26'),
                                array('label'=>'DC News', 'url'=>'//feeds.feedburner.com/historycoalition', 'linkOptions'=>array('target'=>'_blank')),
                            ),
                        ),
                        array('label' => 'At Home', 'url' => array('article/category')),
                    )
                ));
                */
                ?>

                <ul class="nav">
                    <li<?php if ($actionId == 'site/index'): echo " class=\"active\""; endif; ?>><a href="/">Home</a></li>
                    <li class="dropdown<?php if (($route == 'article/category/26') || ($route == 'article/category/55')): echo " active"; endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">News <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/article/category/55">Breaking News</a></li>
                            <li><a href="/article/category/54">Historians</a></li>
                            <li><a href="//feeds.feedburner.com/historycoalition" target="_blank">DC News</a></li>
                        </ul>
                    </li>
                    <li<?php if ($route == 'article/category/3'): echo " class=\"active\""; endif; ?>><a
                                href="/article/category/3">U.S.</a></li>
                    <li<?php if ($route == 'article/category/10'): echo " class=\"active\""; endif; ?>><a
                                href="/article/category/10">World</a></li>
                    <li<?php if ($route == 'article/category/4'): echo " class=\"active\""; endif; ?>><a
                                href="/article/category/2">History</a></li>
                    <li<?php if ($route == 'article/category/15'): echo " class=\"active\""; endif; ?>><a
                                href="/article/category/15">Features</a></li>
                    <li<?php if ($route == 'article/group/3'): echo " class=\"active\""; endif; ?>><a
                                href="/article/group/3">Books</a></li>
                    <li<?php if ($route == 'article/group/2'): echo " class=\"active\""; endif; ?>><a
                                href="/article/group/2">Roundup</a></li>
                    <li class="dropdown<?php if (stristr($route, "blog/author")): echo " active"; endif; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blogs <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($blog_authors as $blog_author_id => $blog_author): ?>
                                <li>
                                    <a href="/blog/author/<?php echo $blog_author_id; ?>">
                                        <?php echo $blog_author; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li`>
                    <li class="dropdown<?php if (stristr($route, 'jobPost/home')): echo " active"; endif; ?>">
                        <a href="<?php echo Yii::$app->urlManager->createUrl(['jobPost/home']); ?>" class="dropdown"
                           style="color:#ffffff">Job Board</a>
                    </li>
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <?php if (Toolshed::userHasRole('superadmin', Yii::$app->user->email)): ?>
                            <li><a href="<?php echo $this->createUrl('article/admin'); ?>">HNN Admin</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>

                <!--
                <form class="navbar-search pull-right" action="/search" method="get">
                    <input name="q" type="text" class="search-query span2" placeholder="Search">
                </form>
                -->
                <style>
                    .gsc-search-button{width:10px !important;}
                </style>
                <div class="pull-right" style="max-width:255px;padding-top: 5px">
                    <gcse:searchbox-only resultsUrl="/search"></gcse:searchbox-only>
                </div>
            </div>
            <!-- /.nav-collapse -->

        </div>
        <!-- /navbar-inner -->
    </div>
    <!-- /div.navbar -->

    <!-- div#ad-top -->
    <?php $ads = HnnAd::getAdsHtml('top'); ?>
    <?= $ads ?>

    <!-- /div#ad-top -->

    <div class="divider-top hidden-phone"></div>

    <section id="main-container" class="row">

        <?= $content ?>

    </section>
    <!-- #footer.container -->
    <footer id="footer" class="container">

        <!-- #copyright.clearfix -->
        <div id="copyright" class="clearfix">

            <p>Copyright <?php echo date('Y'); ?>. All rights reserved.</p>

            <!-- #footer-menu -->
            <nav id="footer-menu">
                <ul class="clearfix">
                    <li><a href="/newsletter.html" class="current" data-description="Home Page">Newsletter</a></li>
                    <li><a href="/submissions.html">Submissions</a></li>
                    <li><a href="/advertising.html">Advertising</a></li>
                    <li><a href="/donations.html">Donations</a></li>
                    <li><a href="/internships.html">Internships</a></li>
                    <li><a href="/masthead.html">Masthead</a></li>
                    <li><a href="/mission-statement.html">Mission Statement</a></li>
                    <li><a href="/faq.html">FAQ</a></li>
                </ul>
                <ul class="clearfix pull-right">
                    <li><a href="//www.freegedpracticetest.com/" target="_blank">Free GED Practice Test</a></li>
                </ul>
            </nav>
            <!-- /#footer-menu -->

        </div>
        <!-- /#copyright .clearfix -->

        <script type="text/javascript" src="/assets/js/foot.js"></script>

    </footer>
    <!-- /#footer .container -->

</section>
<!-- /.container -->
<!-- Mailchimp signup embed begin -->
<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js"
        data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">require(["mojo/signup-forms/Loader"], function (L) {
        L.start({"baseUrl": "mc.us1.list-manage.com", "uuid": "191ccdd6c73c5afeafd52cfb8", "lid": "4b27cc9cc2"})
    })</script>
<!-- Mailchimp signup embed end -->
</body>
</html>
<?php $this->endPage() ?>
