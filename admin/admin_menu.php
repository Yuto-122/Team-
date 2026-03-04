<?php
require_once __DIR__ . "/../functions/function.php";

$db = db_connect();
// TODO nagata: 結合で取得したけどDB管理的に微妙だったら通常に戻す
$sql = "SELECT menus.id AS menu_id, menus.name AS menu_name, shops.name AS shop_name,shops.kana AS shop_kana FROM menus INNER JOIN shops ON menus.shop_id = shops.id";
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
    <title>チーム王将 | メニュー管理画面</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">メニュー管理画面</h1>
        <a href="./menu_add.php">
            <p>メニューの新規登録はこちら</p>
        </a>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>id</th>
                        <th>商品名</th>
                        <th>店舗名</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo $data["menu_id"]; ?></td>
                            <td><?php echo $data["menu_name"]; ?></td>
                            <td><?php echo $data["shop_kana"] == "" ? $data["shop_name"] : $data["shop_name"] . "（" . $data["shop_kana"] . "）"; ?></td>
                            <td><a href="menu_detail.php?id=<?php echo $data["menu_id"] ?>" class="btn btn-primary">詳細</a>
                                <a href="menu_edit.php?id=<?php echo $data["menu_id"] ?>" class="btn btn-success">編集</a>
                                <a href="menu_delete.php?id=<?php echo $data["menu_id"] ?>" class="btn btn-danger">削除</a>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>