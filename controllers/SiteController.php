<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\Article;
use app\models\ArticleSearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $toparticle = Article::find()->limit(8)->orderBy([
            'uploaded_at' => SORT_DESC
          ])->all();
        return $this->render('index.php',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'toparticle'=>$toparticle,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin2()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            return $this->goBack();
        }
        $model->username = '';

        $model->password = '';
        
        return $this->render('/site/login', [
            'model' => $model,
        ]);
    }
    public function actionRegister(){



    
        $model = new User();


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //generating a pass hash for the password
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            //inserting a password which is hashed to the database in the password field
            $model->save(false);
            Yii::$app->session->setFlash('success', 'Account created successfully. continue and login');

            return $this->redirect('login');
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionArticle() {

        $model = new Article();
        
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
        
          

            if ($model->validate(false)) {

                $model->author = Yii::$app->user->id;

                $model->save(false);
                //$this->refresh();
                return $this->redirect(['index']);  //when you click on the submit button in view addproduct it gets you to homepage
            }
        }
    
        return $this->render('article', [
            'model' => $model,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = Article::findOne($id);
        if ($model->load(yii::$app->request->post()) && $model->save()) {

            Yii::$app->getSession()->setFlash('success', 'Post Updated Successfully');
            return $this->redirect(['index','id'=>$model->id]);
        }
        return $this-> render('update',['model'=>$model,]);
    }

    public function actionDelete($id)
    {
        Article::findOne($id)->delete();

        return $this->redirect(['index']);
    }
}
