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


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['create', 'update', 'delete'], // Actions that require authentication
    //             'rules' => [
    //                 [
    //                     'allow' => true,
    //                     'roles' => ['@'], // @ represents authenticated users
    //                 ],
    //             ],
    //         ],
    //     ];
    // }



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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLoginBefore()
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
            // Redirect based on user role
            if (Yii::$app->user->identity->role === 'admin') {
                return $this->redirect(['requests/index']);
            } elseif (Yii::$app->user->identity->role === 'user') {
                return $this->redirect(['requests/create']);
            }
            
            // Handle other roles if needed
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }



    /*public function actionRegister()
    {
        $model = new User();

        // Set the default role to 'user'
        $model->role = 'user';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // Registration successful, redirect to login page or dashboard
            return $this->redirect(['login']);
        }

        return $this->render('register', ['model' => $model]);
    }*/

   /* public function actionRegister()
    {
        $model = new User();
         // Set role to 'user'
         $model->role = 'user';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->username = Yii::$app->request->post('username');
            $model->password = Yii::$app->request->post('password');

            // Generate authKey and accessToken
            $model->authKey = Yii::$app->security->generateRandomString();
            $model->accessToken = Yii::$app->security->generateRandomString();


            // Hash the password
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);

            if ($model->save()) {
                // Registration successful, redirect to login page or dashboard
                return $this->redirect(['login']);
            }
        }

        return $this->render('register', ['model' => $model]);
    }*/



    
    public function actionRegister()
    {
        $model = new User();
        // Set role to 'user'
        $model->role = 'user';

        if ($model->load(Yii::$app->request->post())) {
            // Generate authKey and accessToken
            $model->authKey = Yii::$app->security->generateRandomString();
            $model->accessToken = Yii::$app->security->generateRandomString();

            // Hash the password
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);

            if ($model->save()) {
                // Registration successful, redirect to login page or dashboard
                return $this->redirect(['login']);
            }
        }

        return $this->render('register', ['model' => $model]);
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
}
