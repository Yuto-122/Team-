<?php
require_once __DIR__ . "/../functions/function.php";

// TODO nagata-t:あとで画面全体に追加する
// check_logined();
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
        <div>
            <h1 class="my-5">管理者ページTOP</h1>

            <div class="list-group">
                <a href="admin_menu.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">メニューDB管理</p>
                    <p class="mb-1">（説明を書く）</p>
                </a>
                <a href="admin_shop.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">企業情報DB管理</p>
                    <p class="mb-1">（説明を書く）</p>
                </a>
                <a href="admin_faq_category.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">質問カテゴリDB管理</p>
                    <p class="mb-1">（説明を書く）</p>
                </a>
                <a href="admin_faq.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">質問回答DB管理</p>
                    <p class="mb-1">（説明を書く）</p>
                </a>
                <a href="admin_info.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">お知らせDB管理</p>
                    <p class="mb-1">（説明を書く）</p>
                </a>
                <a href="admin_user.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">ユーザーDB管理</p>
                    <p class="mb-1">管理ユーザーのDB管理画面</p>
                </a>
                <a href="admin_contact.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">お問い合わせDB管理</p>
                    <p class="mb-1">（説明を書く）</p>
                </a>
                <a href="admin_support_status.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">対応状況DB管理</p>
                    <p class="mb-1">お問い合わせ 対応状況のDB管理画面</p>
                </a>
            </div>
        </div>
    </main>
</body>

</html>