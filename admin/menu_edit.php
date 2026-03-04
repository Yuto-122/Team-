<?php
require_once __DIR__ . "/../functions/function.php";

session_start();

if (empty($_GET)) {
    // GETが無かったら戻す
    header("location:admin_contact.php");
    exit();
}

$id = $_GET["id"];

$db = db_connect();
$sql = "SELECT menus.id AS menu_id, menus.name AS menu_name,menus.body AS menu_body,menus.amount AS menu_amount,menus.price AS menu_price,menus.menu_img AS menu_img, shops.name AS shop_name FROM menus INNER JOIN shops ON menus.shop_id = shops.id WHERE menus.id = :id";

$stmt = $db->prepare($sql);

$stmt->bindParam(":id", $id, PDO::PARAM_INT);

$stmt->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);

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
        <h1 class="my-5">メニューDB管理画面</h1>
        <div class="mb-3">
            <form action="menu_edit_do.php?id=<?php echo $data["menu_id"] ?>" method="post" class="needs-validation mb-3">
                <p><b><?php echo $data["shop_name"]?></b></p>
                <label for="menu" class="form-lebel mt-3"><b>商品名</b></label>
                <input type="text" name="menu" id="menu" class="form-control" value="<?php echo $data["menu_name"] ?>">
                <label for="body" class="form-lebel mt-3"><b>商品詳細</b></label>
                <input type="text" name="body" id="body" class="form-control" value="<?php echo $data["menu_body"] ?>">
                <label for="amount" class="form-lebel mt-3"><b>内容個数</b></label>
                <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $data["menu_amount"] ?>">
                <label for="price" class="form-lebel mt-3"><b>商品価格</b></label>
                <input type="text" name="price" id="price" class="form-control" value="<?php echo $data["menu_price"] ?>">
                <!-- 商品画像アップロード -->

                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $data["menu_id"] ?>">
                    <button type="submit" class="btn btn-primary mt-4">保存する</button>
                    <a href="menu_detail.php?id=<?php echo $data["menu_id"] ?>" class="btn btn-success mt-4">一つ戻る</a>
                    <a href="admin_menu.php" class="btn btn-secondary mt-4">一覧に戻る</a>
                </div>
            </form>

    </main>
</body>

</html>