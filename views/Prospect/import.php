<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prospect */

$this->title = 'Import CSV';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
        .card {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px; /* Adjust margin as needed */
        }

        .label-not-active {
            color: red;
        }

        .label-active {
            color: green;
        }
    </style>
 
<div class="card">
    <div class="card-body">
        <h1 class="card-title"><?= Html::encode($this->title) ?></h1>
 
        <div class="prospect-import-users">
            <!-- Import form -->
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
 
            <?= $form->field($model, 'csvFile')->fileInput()->label(false) ?>
 
            <div class="form-group">
                <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
            </div>
 
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
