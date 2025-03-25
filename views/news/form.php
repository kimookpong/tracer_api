<?php
$data = Yii::$app->db->createCommand('SELECT * FROM news')->queryAll();
?>
<div class="container mt-4">
    <h2 class="mb-4">News Management</h2>

    <div class="card p-4 mb-4">
        <h4 id="formTitle">Create News</h4>
        <form method="post">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary">Cancel</button>
        </form>
    </div>
</div>