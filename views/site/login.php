<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: url("https://images.alphacoders.com/135/1350899.png") no-repeat;
      background-position: center;
      background-size: cover;
    }

    .wrapper {
      width: 420px;
      background-color: transparent;
      color: #fff;
      border-radius: 10px;
      padding: 30px 40px;
      border: 2px solid rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .wrapper h1 {
      font-size: 36px;
      text-align: center;
    }

    .wrapper .input-box {
      position: relative;
      width: 100%;
      height: 50px;
      margin: 30px 0;
    }

    .input-box input {
      width: 100%;
      height: 100%;
      background-color: transparent;
      border: none;
      outline: none;
      border: 2px solid rgba(255, 255, 255, 0.2);
      border-radius: 40px;
      font-size: 16px;
      color: #fff;
      padding: 8px 45px 20px 20px;
    }

    .input-box input::placeholder {
      color: #fff;
    }

    .input-box i {
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 20px;
    }

    .wrapper .remember-forgot {
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      margin: -15px 0 15px;
      padding: 12px 45px 20px 20px;

    }

    .remember-forgot label input {
      accent-color: #fff;
      margin-right: 3px;
    }

    .remember-forgot a {
      color: #fff;
      text-decoration: none;
    }

    .remember-forgot a:hover {
      text-decoration: underline;
      color: #568b8c;
    }

    .wrapper .btn {
      width: 100%;
      height: 45px;
      background-color: #fff;
      border: none;
      outline: none;
      border-radius: 40px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      font-size: 16px;
      color: #333;
      font-weight: 600;
      transition: all 0.8s ease-out;
    }

    .wrapper .btn:hover {
      background-color: #568b8c;
      color: #fff;
    }

    .wrapper .register-link {
      font-size: 14px;
      text-align: center;
      margin: 20px 0 15px;
    }

    .register-link p a {
      color: #fff;
      text-decoration: none;
      font-weight: 600;
    }

    .register-link p a:hover {
      text-decoration: underline;
      color: #568b8c;
    }
  </style>
</head>
<body>
<div class="wrapper">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="input-box">
        <?= $form->field($model, 'username')->textInput([ 'placeholder' => 'Username'])->label(false) ?>
        <i class='bx bxs-user'></i>
    </div>
    <div class="input-box">
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
        <i class='bx bxs-lock-alt'></i>
    </div>
    <div class="remember-forgot">
        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<label class='remember-me'>{input} Remember me</label>\n<div class='col-lg-8'>{error}</div>",
        ])->label(false) ?>
        <a href="#">Forgot Password?</a>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Login', ['class' => 'btn', 'name' => 'login-button']) ?>
    </div>
    <div class="register-link">
        <p>Don't have an account? <?= Html::a('Register', ['site/register']) ?></p>
    </div>
    <?php ActiveForm::end(); ?>
</div>
</body>
</html>
