<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
?>

<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <!-- Hide the role field and set its value to 'user' -->
            <?= $form->field($model, 'role')->hiddenInput(['value' => 'user'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
