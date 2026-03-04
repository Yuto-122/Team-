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
        <h1 class="my-5">店舗DB編集画面</h1>
        <div class="mb-3">
            <form action="shop_edit_do.php" method="post" class="mb-3">
                <div class="mb-3">
                    <label for="name" class="form-label">店舗名</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $data["name"]; ?>">
                </div>
                <div class="mb-3">
                    <label for="kana" class="form-label">読み仮名</label>
                    <input type="kana" name="kana" id="kana" class="form-control" value=" <?php echo (!empty($data["kana"])) ?  $data["kana"]  : ""; ?>">
                </div>
                <div class="mb-3">
                    <label for="booth" class="form-label">ブース番号</label>
                    <input type="text" name="booth" id="booth" class="form-control" value="<?php echo $data["booth"]; ?>">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">店舗説明</label>
                    <input type="text" name="description" id="description" class="form-control" value="<?php echo $data["description"]; ?>">
                </div>
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
                    <button type="submit" class="btn btn-primary">登録する</button>
                    <a href="admin_shop.php" class="btn btn-secondary">一覧に戻る</a>
                </div>
            </form>
        </div>



    </main>
</body>

</html>