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
        <?php include('admin-system-message.php');  ?>
        <div>
            <h1 class="my-5">管理者ページTOP</h1>

            <div class="list-group">
                <a href="admin_menu.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">メニュー管理</p>
                    <p class="mb-1">メニュー一覧を見る、メニュー追加、メニュー編集、メニュー削除</p>
                </a>
                <a href="admin_shop.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">店舗情報管理</p>
                    <p class="mb-1">店舗一覧を見る、店舗詳細、店舗追加、店舗編集</p>
                </a>
                <a href="admin_faq_category.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">FAQカテゴリ管理</p>
                    <p class="mb-1">一覧、追加、編集</p>
                </a>
                <a href="admin_faq.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">FAQ管理</p>
                    <p class="mb-1">一覧、新規登録、編集</p>
                </a>
                <a href="admin_info.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">お知らせ管理</p>
                    <p class="mb-1">一覧、追加、編集、削除</p>
                </a>
                <a href="admin_contact.php" class="list-group-item list-group-item-action">
                    <p class="mb-1 fs-5 fw-bold">問い合わせ管理</p>
                    <p class="mb-1">一覧、編集、削除</p>
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