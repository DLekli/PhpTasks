<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Prospect;
use yii\data\ActiveDataProvider;


class ProspectController extends \yii\web\Controller
{
    public function actionIndex77()
    {
        return $this->render('index');
    }




public function actionImport()
{
    if (Yii::$app->user->isGuest) {
        throw new ForbiddenHttpException('You are not allowed to access this page.');
    }
    $model = new Prospect();

    if (Yii::$app->request->isPost) {
        $model->csvFile = UploadedFile::getInstance($model, 'csvFile');

        if ($model->csvFile) {
            
            $file = fopen($model->csvFile->tempName, 'r');

           
            fgetcsv($file);

            
            while (($data = fgetcsv($file)) !== false) {
                $prospect = new Prospect();
                $prospect->email = $data[0];
                $prospect->first_name = $data[1];
                $prospect->last_name = $data[2];
                $prospect->date = isset($data[3]) ? $data[3] : null;
                $prospect->address = isset($data[4]) ? $data[4] : null;
                $prospect->city = isset($data[5]) ? $data[5] : null;
                $prospect->zip = isset($data[6]) ? $data[6] : null;
                $prospect->phone = isset($data[7]) ? $data[7] : null;
                $prospect->fiscal_code = isset($data[8]) ? $data[8] : null;

                
                $prospect->save();
            }

            fclose($file);

            Yii::$app->session->setFlash('success', 'CSV file imported successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'No file uploaded.');
        }
    }

    return $this->render('import', ['model' => $model]);
}

public function actionIndex()
{
    if (Yii::$app->user->isGuest) {
        throw new ForbiddenHttpException('You are not allowed to access this page.');
    }
    $dataProvider = new ActiveDataProvider([
        'query' => Prospect::find(),
        'pagination' => [
            'pageSize' => 10, 
        ],
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}



}
