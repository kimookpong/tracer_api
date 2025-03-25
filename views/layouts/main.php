<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Tracer Backend</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <?php if (Yii::$app->session->has('Tracer@user')) { ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">Tracer Backend</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['user/index']) ?>">จัดการผู้ใช้งาน</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['news/index']) ?>">จัดการผู้ใช้งาน</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['site/logout']) ?>" data-method="post">Logout </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    <?php } ?>

    <div class="container-fluid">
        <div class="p-4">
            <div class="content">
                <?= $content ?>
            </div>

        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>