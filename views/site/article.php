<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="row justify-content-center mt-5">

    <div class="card mb-5 mt-5 col-12 " style="max-width: 35rem;">
        <div class="card-body text-dark">

            <div class="site-upload mt-3">
                <h1>Please upload your article</h1>

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'title') ?>
               
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            

                <div class="form-group">
                    <?= Html::submitButton('save', ['class' => 'btn btn-primary btn-md']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>