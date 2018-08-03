<?php

namespace frontend\controllers;

use Yii;
use app\models\Article;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


//    public function actionIndex($id)
//    {
//        $query = Article::find()->where(['id' => $id]);
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//        return $this->render('index', array(
//            'dataProvider' => $dataProvider,
//        ));
//    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'hnn-2col-alt';
        $article = Article::findOne(['id' => $id]);
//        $category =



            ///////////////////////////////////////

            /*
                    if (empty($article['status']) || $article['status'] != 1)
                        throw new CHttpException(404, 'Page not found.');

                    $category = null;
                    if(isset($article['category_id']))
                    {
                        $category = Category::model()->find('id=:id', array(':id' => $article['category_id']));
                    }

                    $article['lead_text'] = '';
            //		$article['images'] = File::getImages($id, "hnn");

                    $result = Comment::model()->findAllByAttributes(array('nid' => $article['id']), array('order' => 'timestamp desc'));
                    $comments = array();
                    foreach ($result as $row)
                        $comments[] = $row->getAttributes();

                    $article['tags'] = Tag::getTagsByNid($article['id'], "article", true);

            //        echo print_r($comments, true);

                    Yii::app()->clientScript->registerMetaTag($article['title'], null, null, array('property' => 'og:title'));
                    Yii::app()->clientScript->registerMetaTag($article['title']." | History News Network", 'title');
                    Yii::app()->clientScript->registerMetaTag('website', null, null, array('property' => 'og:type'));

                    $imgSrc = Toolshed::getImage($article['body']);
                    if (!empty($imgSrc))
                        Yii::app()->clientScript->registerMetaTag(Yii::app()->params['host'].$imgSrc, null, null, array('property' => 'og:image'));

                    $this->currentArticleTitle = $article['title'];


            //		echo '<pre>'.print_r($article['images'], true).'</pre>';
            */


//        $data = array('data' => array(
//            'article' => $article,
////            'legacy_comments' => $comments,
////            'category'=>$category
//        ));
//
//        return $this->render('detail', $data);


        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
