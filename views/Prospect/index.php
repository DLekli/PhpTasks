<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\data\ActiveDataProvider; // Import ActiveDataProvider

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Prospects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prospect-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

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
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'email',
                'first_name',
                'last_name',
                'date',
                'address',
                'city',
                'zip',
                'phone',
                'fiscal_code',
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>

</div>
