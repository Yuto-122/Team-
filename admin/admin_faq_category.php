<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

try {
    $db = db_connect();

    $sortable = [
        "id" => "id",
    ];

    $sort_params = get_sort_params(
        $sortable,
        $_GET["sort"] ?? "id",
        $_GET["dir"] ?? "asc"
    );

    $sql = "SELECT * FROM faq_category
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
    <title>チーム王将 | 質問カテゴリDB管理画面</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php');  ?>
        <h1 class="my-5">質問カテゴリDB管理画面</h1>
        <a href="faq_category_add.php">
            <p>質問カテゴリDBの新規登録はこちら</p>
        </a>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>
                            <a href="?sort=id&dir=<?php echo next_sort_dir($sort_params['sort'], 'id', $sort_params['dir']); ?>">id</a>
                        </th>
                        <th>カテゴリ名</th>
                        <th>リンクID</th>
                        <th>登録日時</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo $data["id"]; ?></td>
                            <td><?php echo $data["category"]; ?></td>
                            <td><?php echo $data["link_id"]; ?></td>
                            <td><?php echo $data["create_date"]; ?></td>
                            <td><a href="faq_category_edit.php?id=<?php echo $data["id"]; ?>" class="btn btn-secondary mx-1">編集</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>