<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\Tasks;
use app\models\TasksSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

class TasksController extends Controller
{
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

    /*public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Filter tasks based on user role and ID
        if (Yii::$app->user->identity->role === 'admin') {
            // Admin can see all tasks
            $dataProvider->query->all();
        } else {
            // Regular user can only see tasks assigned to them
            $dataProvider->query->andWhere(['assigned_to_id' => Yii::$app->user->id]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /*public function actionIndex()
    {
        $searchModel = new TasksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // Filter tasks based on user role and ID
        if (Yii::$app->user->identity->role === 'admin') {
            // Admin can see all tasks
            $dataProvider->query->all();
        } else {
            // Regular user can only see tasks assigned to them
            $dataProvider->query->andWhere(['assigned_to' => Yii::$app->user->id]); // Corrected column name here
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    

    public function actionView($id)
    {
        $model = $this->findModel($id);

        // Ensure that only the assigned user or admin can view the task
        if ($model->assigned_to !== Yii::$app->user->id && Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException(Yii::t('app', 'You are not allowed to perform this action.'));
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        // Only allow admin users to create tasks
        if (Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException(Yii::t('app', 'You are not allowed to perform this action.'));
        }

        $model = new Tasks();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Ensure that only the assigned user or admin can update the task
        if ($model->assigned_to !== Yii::$app->user->id && Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException(Yii::t('app', 'You are not allowed to perform this action.'));
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /*public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // Ensure that only the assigned user or admin can delete the task
        if ($model->assigned_to !== Yii::$app->user->id && Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException(Yii::t('app', 'You are not allowed to perform this action.'));
        }

        $model->delete();

        return $this->redirect(['index']);
    }*/

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // Check if the user is admin
        if (Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException(Yii::t('app', 'You are not allowed to perform this action.'));
        }

        // Delete the task
        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
