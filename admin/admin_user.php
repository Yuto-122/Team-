<?php
require_once __DIR__ . "/../functions/function.php";

$db = db_connect();
$sql = "SELECT * FROM users";
$stmt = $db->prepare($sql);
$stmt->execute();

$datas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | ユーザーDB管理画面</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php');  ?>
        <h1 class="my-5">ユーザーDB管理画面</h1>
        <a href="user_add.php">
            <p>ユーザーDBの新規登録はこちら</p>
        </a>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                    <tr class="table-primary">
                        <th>ID</th>
                        <th>ユーザー名</th>
                        <th>登録日時</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo $data["id"]; ?></td>
                            <td><?php echo $data["name"]; ?></td>
                            <td><?php echo $data["create_date"]; ?></td>
                            <td><a href="user_edit.php?id=<?php echo $data["id"]; ?>" class=" btn btn-secondary mx-1">編集</a><a href="user_delete.php?id=<?php echo $data["id"]; ?>" class="btn btn-danger mx-1">削除</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>