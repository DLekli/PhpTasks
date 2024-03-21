<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = 'Create Request';
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
    .card-container {
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Adjusted alignment */
        height: 80vh; /* Increased height */
        padding-top: 50px; /* Added padding to top */
    }

    .card {
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        max-width: 600px; /* Increased max-width */
        width: 80%; /* Adjusted width */
        padding: 20px;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-primary {
        width: 100%;
    }
</style>

<div class="card-container">
    <div class="card">
        <div class="card-body">
        <h3>Request</h3>

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'request_text')->textarea(['rows' => 6, 'class' => 'form-control']) ?>

            <?= $form->field($model, 'reCaptcha')->widget(ReCaptcha::class)->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
