<?php

namespace app\views;

use Yii;
use yii\web\View;

$this->registerJs("localStorage.clear();", View::POS_END);

?>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 350px;">
        <h3 class="text-center">Login</h3>
        <form id="loginForm" method="post" action="<?= Yii::$app->urlManager->createUrl(['site/login']) ?>">
            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="LoginForm[username]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="LoginForm[password]" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p id="errorMessage" class="text-danger text-center mt-2" style="display: none;">Invalid login credentials</p>
    </div>
</div>