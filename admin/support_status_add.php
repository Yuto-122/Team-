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
        <h1 class="my-5">対応状況DB - 新規登録</h1>
        <form action="support_status_add_do.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="status" class="form-label">ステータス</label>
                <input type="text" name="status" id="status" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <input type="submit" value="登録する" class="btn btn-primary">
                <a href="admin_support_status.php" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </form>

    </main>
</body>

</html>