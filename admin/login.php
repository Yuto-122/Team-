<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (isset($_SESSION["admin_session_id"])) {
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | 管理者ページ</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php') ?>
        <h1 class="my-5 text-center">ログイン</h1>
        <form action="check_user.php" method="post">
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="name" class="form-label">ユーザー名</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="mb-3 col-6">
                    <label for="password" class="form-label">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="mb-3 text-center">
                <input type="submit" value="ログイン" class="btn btn-primary">
            </div>
        </form>
    </main>
</body>

</html>