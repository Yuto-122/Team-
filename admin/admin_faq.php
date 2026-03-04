<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

try {
    $db = db_connect();

    $sortable = [
        "faq_id" => "faq.id",
        "category" => "faq_category.category",
        "faq_create_date" => "faq.create_date",
    ];

    $sort_params = get_sort_params(
        $sortable,
        $_GET["sort"] ?? "faq_id",
        $_GET["dir"] ?? "asc",
        "faq_id"
    );

    $sql = "SELECT faq.id AS faq_id, faq.question AS faq_question, faq.answer AS faq_answer, faq.create_date AS faq_create_date, faq_category.category AS category
        FROM faq
        INNER JOIN faq_category ON faq.type = faq_category.id
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
    <title>チーム王将 | 質問回答DB管理画面</title>
</head>

<body>
    <?php include('admin-header.php'); ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php'); ?>
        <h1 class="my-5">質問回答DB管理画面</h1>
        <a href="faq_add.php">
            <p>質問回答DBの新規登録はこちら</p>
        </a>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>
                            <a href="?sort=faq_id&dir=<?php echo next_sort_dir($sort_params['sort'], 'faq_id', $sort_params['dir']); ?>">id</a>
                        </th>
                        <th class="w-25">質問</th>
                        <th class="w-25">回答</th>
                        <th>
                            <a href="?sort=category&dir=<?php echo next_sort_dir($sort_params['sort'], 'category', $sort_params['dir']); ?>">項目種別</a>
                        </th>
                        <th>
                            <a href="?sort=faq_create_date&dir=<?php echo next_sort_dir($sort_params['sort'], 'faq_create_date', $sort_params['dir']); ?>">登録日時</a>
                        </th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo $data["faq_id"]; ?></td>
                            <td><?php echo $data["faq_question"]; ?></td>
                            <td><?php echo $data["faq_answer"]; ?></td>
                            <td><?php echo $data["category"]; ?></td>
                            <td><?php echo $data["faq_create_date"]; ?></td>
                            <td>
                                <a href="faq_edit.php?id=<?php echo $data["faq_id"]; ?>" class="btn btn-secondary mx-1">編集</a>
                                <a href="faq_delete.php?id=<?php echo $data["faq_id"]; ?>" class="btn btn-danger mx-1">削除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>