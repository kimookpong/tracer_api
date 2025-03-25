<?php
$data = Yii::$app->db->createCommand('SELECT * FROM news')->queryAll();
?>
<div class="container mt-4">

    <div class="row">
        <div class="col-md-6">
            <h2 class="mb-4">News Management</h2>
        </div>
        <div class="col-md-6">
            <button class="btn btn-primary float-end" onclick="showForm()">Create News</button>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item) { ?>
                <tr>
                    <td><?= $item['id'] ?></td>
                    <td>
                        <div class="row g-2">
                            <div class="col-auto">
                                <img class="rounded " src="<?= $item['image'] ?>" width="100" height="100" alt="">
                            </div>
                            <div class="col">
                                <?= $item['title'] ?>
                            </div>
                        </div>

                    </td>
                    <td>
                        <a class="btn btn-warning" href="<?= Yii::$app->urlManager->createUrl(['news/update', "id" => $item['id']]) ?>">Edit</a>
                        <a class="btn btn-danger" href="<?= Yii::$app->urlManager->createUrl(['news/delete', "id" => $item['id']]) ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>