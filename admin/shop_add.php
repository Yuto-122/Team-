<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | 店舗情報 - 新規登録</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php');  ?>
        <h1 class="mt-5">店舗情報 - 新規登録</h1>
        <p>※読み仮名以外は入力必須です</p>
        <form action="shop_add_do.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="name" class="form-label">店舗名</label>
                <input type="text" name="name" id="name" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <label for="kana" class="form-label">読み仮名</label>
                <input type="text" name="kana" id="kana" class="form-control" value="">
            </div>
            <div class="mb-3">
                <label for="booth" class="form-label">ブース番号(例：B-01)</label>
                <p>※半角で登録してください</p>
                <input type="text" name="booth" id="booth" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">店舗説明文</label>
                <input type="text" name="description" id="description" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <input type="submit" value="登録" class="btn btn-primary">
                <a href="admin_shop.php" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </form>

    </main>
</body>

</html>