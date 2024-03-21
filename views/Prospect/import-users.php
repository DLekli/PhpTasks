<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Import Users from CSV';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="prospect-import-users">
    <!-- Import form -->
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'csvFile')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
 
    <!-- Imported records table -->
    <?php if (!empty($importedRecords)): ?>
        <h2>Imported Records</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Zip</th>
                    <th>Phone</th>
                    <th>Fiscal Code</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($importedRecords as $record): ?>
                    <tr>
                        <td><?= Html::encode($record->email) ?></td>
                        <td><?= Html::encode($record->first_name) ?></td>
                        <td><?= Html::encode($record->last_name) ?></td>
                        <td><?= Html::encode($record->date) ?></td>
                        <td><?= Html::encode($record->address) ?></td>
                        <td><?= Html::encode($record->city) ?></td>
                        <td><?= Html::encode($record->zip) ?></td>
                        <td><?= Html::encode($record->phone) ?></td>
                        <td><?= Html::encode($record->fiscal_code) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
