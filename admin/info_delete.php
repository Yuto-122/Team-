<?php
require_once __DIR__ . "/../functions/function.php";

if (empty($_GET)) {
    header("location:support_info_delete.php");
    exit();
}

$id = (int)$_GET["id"];

try {
    $db = db_connect();
    $sql = "SELECT * FROM info WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    header("location:admin_info.php");
    exit();
}

?>
<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | お知らせ - 削除確認</title>
</head>

<body>
    <?php
    include('admin-header.php');
    ?>


    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">お知らせ - 削除確認</h1>
        <p>タイトル ：「<?php echo h($target["title"]); ?>」</p>
        <p>本文：「<?php echo h($target["body"]); ?>」</p>
        <p>を削除してよろしいですか？</p>

        <form action="info_delete_do.php" method="post">
            <input type="hidden" name="id" value="<?php echo h($target["id"]); ?>">
            <input type="submit" value="削除" class="btn btn-danger">
            <a href="info_delete_do.php" class="btn btn-secondary">一覧に戻る</a>
        </form>
    </main>
</body>

</html>