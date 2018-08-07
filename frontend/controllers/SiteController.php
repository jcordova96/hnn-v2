<?php
namespace frontend\controllers;

use app\models\Article;
use app\models\Blog;
use app\models\HnnAd;
use app\models\StaticPage;
use app\models\BlogAuthor;
use app\models\Category;
use app\models\CategoryGroup;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use Zend\Feed\Writer\Feed;
use app\components\Toolshed;

//Yii::import('application.vendors.*');
//Yii::setPathOfAlias('Zend', Yii::getPathOfAlias('application.vendors.Zend'));


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout', 'signup'],
//                'rules' => [
//                    [
//                        'actions' => ['signup'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * {@inheritdoc}
     */
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
//        ];
//    }

    public $layout = 'hnn-main-1';

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'hnn-2col-main';


        $ads = HnnAd::findOne(['slot' => 'right_sidebar']);

        $data = array(
            'data' => array(
                'recent_articles' => Article::getFrontPageArticles(),
                'main_article' => Article::getMainArticle(),
                'ads' => $ads,
            )
        );

        return $this->render('index-new', $data);
    }











    public function actionFeed($type = 'default', $subcat = 'default', $id = 0)
    {
        $feed = new Feed;
        $feed_title = "";
        $feed_description = "";
        $front_page_content = false;
        $items = array();

        $useXmlExt = true;
        switch ($type) {
            case"article":
                if ($subcat == 'category') {
                    $items = Article::getArticleByCategory($id, array('limit' => 20));
                    $feed_title = Category::findOne(['id' => $id])->getAttribute('name');
                    $feed_description = $feed_title . " articles brought to you by History News Network.";
                    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/article/category/' . $id;
                } elseif ($subcat == 'group') {
                    $items = Article::getArticleByCategoryGroup($id, array('limit' => 20));
                    $feed_title = CategoryGroup::findOne(['id' => $id])->getAttribute('name');
                    $feed_description = $feed_title . " - articles brought to you by History News Network.";
                    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/article/group/' . $id;
                } else {
                    throw new BadRequestHttpException('RSS feed not found.', 404);
                }
                break;

            case"blog":
                $items = Blog::getBlogByAuthor($id);
                $feed_title = BlogAuthor::findOne(['id' => $id])->getAttribute('author');
                $feed_description = $feed_title . " blog brought to you by History News Network.";
                $url = 'https://' . $_SERVER['HTTP_HOST'] . '/blog/author/' . $id;
                break;

            default:
                $items = Article::getFrontPageArticles();
                $front_page_content = true;
                $feed_title = "History News Network - Front Page";
                $feed_description = $feed_title . " articles brought to you by History News Network.";
                $url = 'https://' . $_SERVER['HTTP_HOST'] . '/site/feed';
                $useXmlExt = false;
                break;
        }

        $feed->setTitle($feed_title);
        $feed->setDescription($feed_description);
        $feed->setLink($url);
        if ($useXmlExt) {
            $feed->setFeedLink($url . '/rss.xml', 'rss');
        } else {
            $feed->setFeedLink($url, 'rss');
        }
//        $feed->addAuthor(array(
//            'name' => 'History News Network',
//            'email' => 'editor@hnn.us',
//            'uri' => 'http://www.hnn.us',
//        ));

        $feed->setDateModified(time());

        //each item
        foreach ($items as $item) {
            //make sure author exists; required
            $author = (empty($item['author'])) ? "no author cited" : $item['author'];
            $blog_author = (empty($feed_title)) ? "no author cited" : $feed_title;

            //type specific data adjustment
            if (($type == 'article') || ($type == 'default')) {
                $item_type = ($front_page_content) ? $item['type'] : "article";
                $link = 'https://historynewsnetwork.org/' . $item_type . '/' . $item['id'];
                $author = array('name' => $author, 'email' => 'editor@hnn.us');
            } elseif ($type == 'blog') {
                $link = 'https://historynewsnetwork.org/blog/' . $item['id'];
                $author = array('name' => $blog_author, 'email' => 'editor@hnn.us');
            }
//            elseif()
//            {
//                $link = 'http://hnn.us';
//                $author = array('name' => 'diverse');
//            }

            //$description = (empty($item['teaser'])) ? "no description provided" : $item['teaser'];
            $description = strip_tags($item['body'],'<p><a><ul><li><table><tr><th><td><h1><h2><h3><h4><h5><b><strong>');
            $title = (empty($item['title'])) ? "no title provided" : $item['title'];

            $entry = $feed->createEntry();
            $entry->setTitle($title);
            $entry->setLink($link);
            //$entry->addAuthor($author);
            $entry->setDateModified(time());
            $entry->setDateCreated(intVal($item['created']));
            $entry->setDescription($description);

            $feed->setLastBuildDate(time());
            $feed->addEntry($entry);
        }

        $out = $feed->export('rss');

        header('Content-Type: text/xml');

//        $this->layout = 'blank';
//        return $this->render('feed', [
//            'feed' => $out,
//        ]);

        ini_set('display_errors','Off');
        echo $out;


//        Yii::$app->end();
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionStatic($slug)
    {
        $this->layout = 'hnn-3col';

        $content = StaticPage::getContent($slug);
        if (!empty($content)) {
            $this->render('static', array('content' => $content));
        } else {
            throw new BadRequestHttpException('Page not found.', 404);
        }
    }

    public function actionError()
    {
        if ($error = Yii::$app->errorHandler->error) {
            if ($error['code'] == 404) {
//                $this->checkLegacyUrls();
                $this->layout = 'hnn-3col';
                $this->render('error_404', $error);
            } else {
                if (Yii::$app->request->isAjaxRequest) {
                    echo $error['message'];
                } else {
                    $this->render('error', $error);
                }

            }
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $this->layout = 'hnn-3col';

        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-type: text/plain; charset=UTF-8";

                mail(Yii::$app->params['adminEmail'], $subject, $model->body, $headers);
                Yii::$app->user->setFlash('contact',
                    'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'hnn-3col';
        $model = new LoginForm();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            $model->load(\Yii::$app->request->post());
            echo $model->validate();
            Yii::$app->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (Toolshed::userHasRole('superadmin', $model->username) || Toolshed::userHasRole('article_editor',
                        $model->username)) {
                    Yii::$app->user->returnUrl = Yii::$app->getUrlManager()->createUrl('article/admin');
                } elseif (Toolshed::userHasRole('blog_author', $model->username)) {
                    Yii::$app->user->returnUrl = Yii::$app->getUrlManager()->createUrl('blog/admin');
                } else {
                    Yii::$app->user->returnUrl = Yii::$app->getUrlManager()->createUrl('user/account',
                        array('user_id' => Yii::$app->user->user_id));
                }

                $this->redirect(Yii::$app->user->returnUrl);
            }
        }

        // display the login form
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }




























//    /**
//     * Logs in a user.
//     *
//     * @return mixed
//     */
//    public function actionLogin()
//    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }
//
//        $model = new LoginForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        } else {
//            $model->password = '';
//
//            return $this->render('login', [
//                'model' => $model,
//            ]);
//        }
//    }
//
//    /**
//     * Logs out the current user.
//     *
//     * @return mixed
//     */
//    public function actionLogout()
//    {
//        Yii::$app->user->logout();
//
//        return $this->goHome();
//    }
//
//    /**
//     * Displays contact page.
//     *
//     * @return mixed
//     */
//    public function actionContact()
//    {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
//                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
//            } else {
//                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
//            }
//
//            return $this->refresh();
//        } else {
//            return $this->render('contact', [
//                'model' => $model,
//            ]);
//        }
//    }
//
//    /**
//     * Displays about page.
//     *
//     * @return mixed
//     */
//    public function actionAbout()
//    {
//        return $this->render('about');
//    }
//
//    /**
//     * Signs user up.
//     *
//     * @return mixed
//     */
//    public function actionSignup()
//    {
//        $model = new SignupForm();
//        if ($model->load(Yii::$app->request->post())) {
//            if ($user = $model->signup()) {
//                if (Yii::$app->getUser()->login($user)) {
//                    return $this->goHome();
//                }
//            }
//        }
//
//        return $this->render('signup', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     * Requests password reset.
//     *
//     * @return mixed
//     */
//    public function actionRequestPasswordReset()
//    {
//        $model = new PasswordResetRequestForm();
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            if ($model->sendEmail()) {
//                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
//
//                return $this->goHome();
//            } else {
//                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
//            }
//        }
//
//        return $this->render('requestPasswordResetToken', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     * Resets password.
//     *
//     * @param string $token
//     * @return mixed
//     * @throws BadRequestHttpException
//     */
//    public function actionResetPassword($token)
//    {
//        try {
//            $model = new ResetPasswordForm($token);
//        } catch (InvalidParamException $e) {
//            throw new BadRequestHttpException($e->getMessage());
//        }
//
//        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
//            Yii::$app->session->setFlash('success', 'New password saved.');
//
//            return $this->goHome();
//        }
//
//        return $this->render('resetPassword', [
//            'model' => $model,
//        ]);
//    }
}
