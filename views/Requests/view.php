<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Requests $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// Set the CSS class based on the status
$statusClass = $model->status ? 'label label-success' : 'label label-danger';

?>
<div class="requests-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'request_text:ntext',
            'created_at',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    // Determine the label text and CSS class based on the status
                    $statusLabel = $model->status ? 'ACTIVE' : 'NOT ACTIVE';
                    $statusClass = $model->status ? 'label label-success' : 'label label-danger';

                    // Return the HTML with the appropriate CSS class
                    return Html::tag('span', $statusLabel, ['class' => $statusClass]);
                },
            ],
        ],
    ]) ?>

</div>
