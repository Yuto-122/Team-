<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
check_logined();

if (empty($_GET)) {
    // GETが無かったら戻す
    header("location:admin_contact.php");
    exit();
}

$id = $_GET["id"];

$db = db_connect();
$sql = "SELECT menus.id AS menu_id, menus.name AS menu_name,menus.body AS menu_body,menus.amount AS menu_amount,menus.price AS menu_price,menus.menu_img AS menu_img,menus.menu_b_pc_img AS menu_img_pc,menus.menu_b_sp_img AS menu_img_sp, shops.name AS shop_name FROM menus INNER JOIN shops ON menus.shop_id = shops.id WHERE menus.id = :id";

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
            <form action="menu_edit_do.php?id=<?php echo $data["menu_id"] ?>" method="post" class="needs-validation mb-3" enctype="multipart/form-data">
                <p><b><?php echo $data["shop_name"] ?></b></p>
                <label for="menu" class="form-lebel mt-3"><b>商品名</b></label>
                <input type="text" name="menu" id="menu" class="form-control" value="<?php echo $data["menu_name"] ?>">
                <label for="body" class="form-lebel mt-3"><b>商品詳細</b></label>
                <input type="text" name="body" id="body" class="form-control" value="<?php echo $data["menu_body"] ?>">
                <label for="amount" class="form-lebel mt-3"><b>内容個数</b></label>
                <input type="text" name="amount" id="amount" class="form-control" value="<?php echo $data["menu_amount"] ?>">
                <label for="price" class="form-lebel mt-3"><b>商品価格</b></label>
                <input type="text" name="price" id="price" class="form-control" value="<?php echo $data["menu_price"] ?>">
                <!-- 商品画像アップロード -->
                <div class="mb-3 row">
                    <label for="menu_img" class="form-label mt-3">商品画像</label>
                    <input type="file" name="menu_img" id="menu_img">
                    <input type="hidden" name="menu_img" id="menu_img" value="<?php echo $data["menu_img"] ?>">
                    <div class="invalid-feedback">
                        投稿者を入力してください
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label for="image_pc" class="form-label mt-3">PC用 商品画像</label>
                            <input type="file" name="menu_img_pc" id="menu_img_pc" class="form-control">
                            <input type="hidden" name="menu_img_pc" id="menu_img_pc" value="<?php echo $data["menu_img_pc"] ?>">
                            <div class="invalid-feedback">
                                投稿者を入力してください
                            </div>
                        </div>
                        <div class="col">
                            <label for="image_sp" class="form-label mt-3">スマートフォン用 商品画像</label>
                            <input type="file" name="menu_img_sp" id="menu_img_sp" class="form-control">
                            <input type="hidden" name="menu_img_sp" id="menu_img_sp" value="<?php echo $data["menu_img_sp"] ?>">
                            <div class="invalid-feedback">
                                投稿者を入力してください
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $data["menu_id"] ?>">
                    <button type="submit" class="btn btn-primary mt-4">登録</button>
                    <a href="menu_detail.php?id=<?php echo $data["menu_id"] ?>" class="btn btn-success mt-4">一つ戻る</a>
                    <a href="admin_menu.php" class="btn btn-secondary mt-4">一覧に戻る</a>
                </div>
            </form>

    </main>
</body>

</html>