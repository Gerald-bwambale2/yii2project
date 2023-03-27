<?php

use yii\helpers\Url;
use yii\bootstrap4\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">




    <div class="body-content pt-5 mt-5">
        <div class="row">

            <div class="col-lg-3">
                <div class="card mt-1">
                    <div class="card-body">
                        <h2>Articles <br>Sites</h2>

                        <h3>Upload Your Articles</h3>

                        <?php if (Yii::$app->user->isGuest) : ?>
                            <div class="form-group">

                                <a href=<?= Url::toRoute(['site/register',]) ?> type="button" class="btn btn-outline-primary btn-block  btn-sm">Create account</a>
                                <a href=<?= Url::toRoute(['site/login',]) ?> type="button" class="btn btn-outline-primary btn-block   btn-sm">Login</a>
                            </div>
                        <?php else : ?>
                            <a class="btn btn-outline-success" aria-current="page" href="<?= Url::to(['site/article']) ?>">Upload Article</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <nav class="">
                        <a class="nav-link active log1" href="#"><i class="bi bi-heart"></i>reactions</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-chat"></i>comments</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-airplane"></i>Airplane</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-house-fill"></i>Homes</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-globe"></i>Global</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-camera-reels-fill"></i>Videos</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-tags"></i>Tags</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-lightbulb-fill"></i>FAQ</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-bag-check-fill"></i>Forem Shop</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-file-person"></i>About</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-person-lines-fill"></i>Contact</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-book"></i>Guides</a>
                        <a class="nav-link log1" href="#"><i class="bi bi-music-note-beamed">Music</i> </a>
                    </nav>
                </div>
            </div>

            <div class="col-lg-6">


            <?php foreach ($toparticle as $data) :
                ?>
                    <div class="card  border-danger mb-2">
                        <nav class="nav mt-1">
                            <div class="card-body">
                            
                                <nav class="nav mt-1">

                                    <a class="nav-link active log3 " aria-current="page" href="#"><?= $data->id ?></a>
                                    <a class="nav-link log3 " href="#"><?= $data->title ?></a>
                                    

                                    <a class="nav-link log3 " href="#"><?= $data->author ?></a>
                                    <a class="nav-link log3 " href="#"><?= Yii::$app->formatter->asRelativeTime($data->uploaded_at) ?></a>
                                    <a class="nav-link log3 " href="#"><?= $data->description ?></a>
                                </nav>
                            </div>
                        </nav>
                        <nav class="nav">
                            <a class="nav-link active log1" href="#"><i class="bi bi-heart"></i>reactions</a>
                            <a class="nav-link log1" href="#"><i class="bi bi-chat"></i>comments</a>


                        </nav>
                        <?php if (Yii::$app->user->isGuest) : ?>


                        <?php else : ?>
                            <?php if (Yii::$app->user->identity->id == $data->author) : ?>
                                <p>

                                    <?= Html::a('Update', ['site/update', 'id' => $data->id], ['class = text-primary log2' => 'btn btn-sm ']) ?>
                                    <?= Html::a('Delete', ['site/delete', 'id' => $data->id], [
                                        'class = text-danger log2' => 'btn btn-sm ',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to delete this item?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </p>
                            <?php endif; ?>
                        <?php endif; ?>




                    </div>
                <?php endforeach;
                ?>
            
            </div>

            <div class="col-lg-3">
                <?php foreach ($toparticle as $data) :
                ?>
                    <div class="card mb-2">
                        <div class="card-body">
            
                            <nav class="nav mt-1">
                                <a class="nav-link log3 " href="#"><?= $data->title ?></a>

                                <a class="nav-link log3 " href="#"><?= $data->description ?></a>
                            </nav>
                        </div>
                    </div>
                <?php endforeach;
                ?>
            </div>
            

        </div>

    </div>

</div>