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
$sql = "SELECT menus.id AS menu_id, menus.name AS menu_name,menus.body AS menu_body,menus.amount AS menu_amount,menus.price AS menu_price,menus.menu_img AS menu_img,menus.menu_b_pc_img AS pc_img,menus.menu_b_sp_img AS sp_img, shops.name AS shop_name FROM menus INNER JOIN shops ON menus.shop_id = shops.id WHERE menus.id = :id";

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
        <h1 class="my-5">メニュー管理画面</h1>
        <div class="mb-3">
            <p><b>店舗名</b></p>
            <p><?php echo $data["shop_name"] . "（店舗ID:" . $data["menu_id"] . "）" ?></p>
            <p><b>商品名</b></p>
            <p><?php echo h($data["menu_name"]) ?></p>
            <p><b>商品詳細</b></p>
            <p><?php echo h($data["menu_body"]) ?></p>
            <p><b>内容個数</b></p>
            <p><?php echo h($data["menu_amount"]) . "個" ?></p>
            <p><b>商品価格</b></p>
            <p><?php echo $data["menu_price"] . "円" ?></p>
            <p><b>商品画像</b></p>
            <div class="row">
                <div class="col">
                    <img src="../img/menu/<?php echo $data["menu_img"] ?>" alt="<?php echo $data["menu_img"] ?>">
                    <p>画像先：<?php echo "C:/xampp/htdocs/gyoza-fes_c/img/menu/" . $data["menu_img"] ?></p>
                </div>
            </div>

        </div>
        <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $data["menu_id"]; ?>">
            <a href="menu_edit.php?id=<?php echo $data["menu_id"] ?>" class="btn btn-success">編集</a>
            <a href="admin_menu.php" class="btn btn-secondary">一覧に戻る</a>
        </div>
        </form>

    </main>
</body>

</html>