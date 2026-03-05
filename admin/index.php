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
    <title>チーム王将 | 管理者TOPページ</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php');  ?>
        <div>
            <h1 class="my-5">管理者ページTOP</h1>

            <div class="list-group">
                <a href="admin_menu.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">メニュー管理</p>
                    <p class="mb-1">メニュー一覧、メニュー登録、メニュー編集、メニュー削除</p>
                </a>
                <a href="admin_shop.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">店舗情報管理</p>
                    <p class="mb-1">店舗一覧、店舗詳細、店舗登録、店舗編集</p>
                </a>
                <a href="admin_faq_category.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">FAQカテゴリ管理</p>
                    <p class="mb-1">カテゴリ一覧、カテゴリ登録、カテゴリ編集</p>
                </a>
                <a href="admin_faq.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">FAQ管理</p>
                    <p class="mb-1">FAQ一覧、FAQ登録、FAQ編集、FAQ削除</p>
                </a>
                <a href="admin_info.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">お知らせ管理</p>
                    <p class="mb-1">お知らせ一覧、お知らせ登録、お知らせ編集、お知らせ削除</p>
                </a>
                <a href="admin_contact.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">問い合わせ管理</p>
                    <p class="mb-1">問い合わせ一覧、問い合わせ詳細、ステータス変更、問い合わせ削除</p>
                </a>
                <a href="admin_support_status.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">問い合わせステータス追加</p>
                    <p class="mb-1">問い合わせステータスの追加が可能です</p>
                </a>
                <a href="admin_user.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">管理者一覧</p>
                    <p class="mb-1">管理者情報の追加、編集、削除ができます</p>
                </a>
            </div>
        </div>
    </main>
</body>

</html>