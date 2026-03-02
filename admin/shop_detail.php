<?php
require_once __DIR__ . "/../functions/function.php";

if (empty($_GET)) {
    // GETが無かったら戻す
    header("location:admin_shop.php");
    exit();
}

$id = $_GET["id"];

// DB接続
try {
    $db = db_connect();
    $sql = "SELECT * FROM shops WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // 結果セットを連想配列の形で取得
    $target = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    exit('エラー: ' . $e->getMessage());
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
        <h1 class="my-5">店舗DB詳細画面</h1>
        <div class="mb-3">
            <p><b>ID</b></p>
            <p><?php echo $data["id"]; ?></p>
            <p><b>店舗名</b></p>
            <p><?php echo $data["name"]; ?></p>
            <p><b>読み仮名</b></p>
            <?php echo (!empty($data["kana"])) ?  $data["kana"]  : "なし"; ?>
            <p><b>ブース情報</b></p>
            <p><?php echo $data["booth"]; ?></p>
            <p><b>店舗説明</b></p>
            <p><?php echo $data["description"]; ?></p>
            <p><b>更新日時</b></p>
            <p><?php echo $data["update_date"]; ?></p>
            <p><b>作成日時</b></p>
            <p><?php echo $data["created_date"]; ?></p>
        </div>
        <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
            <a href="admin_shop_edit.php?id=<?php echo $data["id"] ?>" class="btn btn-primary">編集</a>
            <a href="admin_shop.php" class="btn btn-secondary">一覧に戻る</a>
        </div>
        </form>

    </main>
</body>

</html>