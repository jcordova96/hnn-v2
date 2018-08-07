<?php

namespace frontend\controllers;

use Yii;
use app\models\Blog;
use app\models\BlogAuthor;
use app\models\Comment;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
/**
 * BlogController implements the CRUD actions for Blog model.
 */
class BlogController extends Controller
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

    public function actionAuthor($id)
    {
        $this->layout = 'hnn-3col';
        $query = Blog::find()->where(['status' => 1, 'author_id' => $id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $blog_entries = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $data = array('data' => array(
                'author' => BlogAuthor::findOne(['id' => $id]),
                'blog_entries' => $blog_entries,
            ),
            'pagination' => $pagination,
        );

        return $this->render('author', $data);
    }

    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Blog::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Blog model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'hnn-2col-alt';
        $blog = Blog::findOne(['id' => $id, 'status' => 1]);
        if(empty($blog)) {
            throw new yii\web\NotFoundHttpException(404);
        }

//        $blog['lead_text'] = '';
//           $blog['images'] = File::getImages($id, "hnn");

        $comments = Comment::find()->where(['nid' => $blog->id])->orderBy(['timestamp' => SORT_DESC])->all();

        \Yii::$app->view->registerMetaTag(['og:title' => $blog->title, 'title' => $blog->title]);

        $data = array('data' => array(
            'blog' => $blog,
            'legacy_comments' => $comments,
        ));

        return $this->render('detail', $data);
    }

    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Blog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Blog model.
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
     * Deletes an existing Blog model.
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
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
