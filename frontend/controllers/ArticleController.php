<?php

namespace frontend\controllers;

use app\models\Category;
use app\models\CategoryGroup;
use app\models\Comment;
use Yii;
use app\models\Article;
use frontend\models\ArticleSearch;
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

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
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
        $article = Article::findOne(['id' => $id, 'status' => 1]);
        if(empty($article)) {
            throw new yii\web\NotFoundHttpException(404);
        }

//        $article['lead_text'] = '';
//           $article['images'] = File::getImages($id, "hnn");

        $comments = Comment::find()->where(['nid' => $article->id])->orderBy(['timestamp' => SORT_DESC])->all();

        \Yii::$app->view->registerMetaTag(['og:title' => $article->title, 'title' => $article->title]);

        $data = array('data' => array(
            'article' => $article,
            'legacy_comments' => $comments,
        ));

        return $this->render('detail', $data);
    }

    public function actionCategory($id)
    {
        $this->layout = 'hnn-3col';
        $category = Category::findOne(['id' => $id]);
        if (!empty($category)) {
            $articles = Article::getArticleByCategory($id, array('limit' => 20));
            $data = array('data' => array(
                'articles' => $articles,
                'category_id' => $id,
            ));
            return $this->render('category', $data);
        }
        else {
            throw new yii\web\NotFoundHttpException(404);
        }
    }

    public function actionGroup($id)
    {
        $this->layout = 'hnn-3col';

        $data = array('data' => array(
            'articles' => Article::getArticleByCategoryGroup($id, array('limit' => 20)),
            'category' => CategoryGroup::findOne(['id' => $id])->getAttribute('name'),
            'group_id' => $id,
        ));

        return $this->render('category', $data);
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
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
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
