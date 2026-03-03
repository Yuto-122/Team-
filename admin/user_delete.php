<?php
require_once __DIR__ . "/../functions/function.php";

if (empty($_GET)) {
    header("location:admin_user.php");
    exit();
}

$id = (int)$_GET["id"];

try {
    $db = db_connect();
    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    header("location:admin_user.php");
    exit();
}
?>
<!doctype html>
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
        <h1 class="my-5">ユーザーDB - 削除確認</h1>
        <p>ユーザー「<?php echo $target["name"]; ?>」を削除してよろしいですか？</p>
        <p><a href="admin_user.php" class="btn btn-primary">ユーザー一覧に戻る</a></p>
        <form action="user_del_do.php" method="post">
            <input type="hidden" name="id" value="<?php echo $target["id"]; ?>">
            <input type="submit" value="削除" class="btn btn-danger">
        </form>
    </main>
</body>

</html>