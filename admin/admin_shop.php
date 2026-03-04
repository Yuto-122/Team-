<?php
require_once __DIR__ . "/../functions/function.php";

try {
    $db = db_connect();
    $sql = "SELECT id,name,kana,booth FROM shops";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>チーム王将 | 店舗DB管理画面</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php');  ?>
        <h1 class="my-5">店舗DB管理画面</h1>
        <a href="shop_add.php">
            <p>店舗DBの新規登録はこちら</p>
        </a>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>id</th>
                        <th>店舗名</th>
                        <th>読み仮名</th>
                        <th>ブース番号</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo $data["id"]; ?></td>
                            <td><?php echo $data["name"]; ?></td>
                            <td><?php echo $data["kana"]; ?></td>
                            <td><?php echo $data["booth"]; ?></td>
                            <td><a href="shop_detail.php?id=<?php echo $data["id"]; ?>" class="btn btn-primary mx-1">詳細</a>
                                <a href="shop_edit.php?id=<?php echo $data["id"]; ?>" class="btn btn-secondary mx-1">編集</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>