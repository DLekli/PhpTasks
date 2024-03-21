<?php

use app\models\Requests;
use app\models\User; // Assuming your User model namespace is 'app\models\User'
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\RequestsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <style>
        .card {
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            padding: 20px;
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
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                [
                    'attribute' => 'user_id',
                    'value' => function ($model) {
                        // Fetch the user's name from the User model based on the user_id
                        $user = User::findOne($model->user_id);
                        return $user ? $user->username : ''; // Return empty string if $user is null
                    },
                ],
                'request_text:ntext',
                'created_at',
                [
                    'attribute' => 'status',
                    'value' => function ($model) {
                        return $model->status ?
                            Html::tag('span', 'ACTIVE', ['class' => 'label label-success label-active']) :
                            Html::tag('span', 'NOT ACTIVE', ['class' => 'label label-danger label-not-active']);
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Requests $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'data' => [
                                    'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

    <?php Pjax::end(); ?>

</div>
