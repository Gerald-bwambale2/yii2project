<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="container">
<div class="row justify-content-center mt-5">

    <div class="card mb-5 mt-5 col-12 " style="max-width: 35rem;">
        <div class="card-body text-dark">

            <div class="site-register mt-3">
                <h1>Please create Account</h1>
<hr>
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'firstname') ?>
                <?= $form->field($model, 'lastname') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-md']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
</div>