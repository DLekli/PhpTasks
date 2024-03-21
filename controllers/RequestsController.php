<?php

namespace app\controllers;
use Yii;
use yii\web\ForbiddenHttpException;


use app\models\Requests;
use app\models\RequestsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\captcha\CaptchaAction;
use himiklab\yii2\recaptcha\ReCaptchaValidator2;


/**
 * RequestsController implements the CRUD actions for Requests model.
 */
class RequestsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

   

    public function actionIndex()
    {
    if (Yii::$app->user->identity->role !== 'admin') {
        throw new ForbiddenHttpException('You are not allowed to access this page.');
    }

    $searchModel = new RequestsSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
    }


    

    public function actionView($id)
    {
    if (Yii::$app->user->identity->role !== 'admin') {
        throw new ForbiddenHttpException('You are not allowed to access this page.');
    }
    $model = $this->findModel($id);

    $model->status = 1;
    if ($model->save()) {
        Yii::$app->session->setFlash('success', 'Status updated successfully.');
    } else {
        Yii::$app->session->setFlash('error', 'Failed to update status.');
    }

    return $this->render('view', [
        'model' => $model,
    ]);
    }   


    public function actionCreate()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'user') {
            throw new ForbiddenHttpException('You are not allowed to perform this action.');
        }
        
        $model = new Requests();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
          
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Form submitted successfully.');
                
            $model->request_text = '';
            } else {
                Yii::$app->session->setFlash('error', 'Failed to save the model.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }



   
   
    

    /**
     * Updates an existing Requests model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Requests model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Requests model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Requests the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Requests::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
