<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

try {
    $db = db_connect();

    $sortable = [
        "id" => "id",
        "public_date" => "public_date",
        "update_date" => "update_date",
        "created_date" => "created_date",
    ];

    $sort_params = get_sort_params(
        $sortable,
        $_GET["sort"] ?? "id",
        $_GET["dir"] ?? "asc"
    );

    $sql = "SELECT * FROM info
            ORDER BY " . $sort_params["order_by"];
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
    set_error_log($e->getMessage());
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | お知らせ管理画面</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">お知らせ管理画面</h1>
        <a href="./info_add.php">
            お知らせの新規登録はこちら
        </a>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>
                            <a href="?sort=id&dir=<?php echo next_sort_dir($sort_params['sort'], 'id', $sort_params['dir']); ?>">id</a>
                        </th>
                        <th>タイトル</th>
                        <th>本文</th>
                        <th>お知らせ画像名</th>
                        <th>
                            <a href="?sort=public_date&dir=<?php echo next_sort_dir($sort_params['sort'], 'public_date', $sort_params['dir']); ?>">公開日時</a>
                        </th>
                        <th>
                            <a href="?sort=update_date&dir=<?php echo next_sort_dir($sort_params['sort'], 'update_date', $sort_params['dir']); ?>">更新日時</a>
                        </th>
                        <th>
                            <a href="?sort=created_date&dir=<?php echo next_sort_dir($sort_params['sort'], 'created_date', $sort_params['dir']); ?>">登録日時</a>
                        </th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo h($data["id"]); ?></td>
                            <td><?php echo h($data["title"]); ?></td>
                            <td><?php echo h($data["body"]); ?></td>
                            <td><?php echo h($data["info_img"]); ?></td>
                            <td><?php echo h(date('Y年n月j日 H:i:s', strtotime($data["public_date"]))); ?></td>
                            <td><?php echo h(date('Y年n月j日 H:i:s', strtotime($data["update_date"]))); ?></td>
                            <td><?php echo h(date('Y年n月j日 H:i:s', strtotime($data["created_date"]))); ?></td>
                            <td>
                                <!-- <a href="">
                                    <button type="button" class="btn btn-primary mx-1">詳細</button>
                                </a> -->
                                <a href="./info_edit.php?id=<?php echo h($data["id"]); ?>" class="btn btn-success mx-1">編集</a>
                                <a href="./info_delete.php?id=<?php echo h($data["id"]); ?>" class="btn btn-danger mx-1">削除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>