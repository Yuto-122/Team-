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
            <ul class="list-group my-3">
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_menu.php">
                        <span class="post-title">メニューDB管理画面</span>
                    </a>
                </li>
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_shop.php">
                        <span class="post-title">企業情報DB管理画面</span>
                    </a>
                </li>
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_faq_category.php">
                        <span class="post-title">質問カテゴリDB管理画面</span>
                    </a>
                </li>
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_faq.php">
                        <span class="post-title">質問回答DB管理画面</span>
                    </a>
                </li>
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_info.php">
                        <span class="post-title">お知らせDB管理画面</span>
                    </a>
                </li>
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_user.php">
                        <span class="post-title">ユーザーDB管理画面</span>
                    </a>
                </li>
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_contact.php">
                        <span class="post-title">お問い合わせDB管理画面</span>
                    </a>
                </li>
                <li class="list-group-item py-3">
                    <a class="post-link" href="admin_support_status.php">
                        <span class="post-title">対応状況DB管理画面</span>
                    </a>
                </li>
            </ul>
        </div>
    </main>
</body>

</html>