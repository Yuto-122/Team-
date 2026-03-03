<?php
require_once __DIR__ . "/../functions/function.php";

$db = db_connect();
$sql = "SELECT contact.id AS contact_id,contact.name AS contact_name,contact.kana AS contact_kana,contact.receive_date AS receive_date,contact.update_date AS update_date,support_status.status AS status FROM contact INNER JOIN support_status ON contact.status = support_status.id";
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
    <title>チーム王将 | お問い合わせDB管理画面</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <h1 class="my-5">お問い合わせDB管理画面</h1>
        <a href="#">
            <p>お問い合わせDBの新規登録はこちら</p>
        </a>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>フリガナ</th>
                        <th>送信日時</th>
                        <th>更新日時</th>
                        <th>対応状況</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $data): ?>
                        <tr>
                            <td><?php echo $data["contact_id"]; ?></td>
                            <td><?php echo h($data["contact_name"]); ?></td>
                            <td><?php echo h($data["contact_kana"]); ?></td>
                            <td><?php echo $data["receive_date"]; ?></td>
                            <td><?php echo $data["update_date"]; ?></td>
                            <td><?php echo $data["status"]; ?></td>
                            <td><a href="admin_contact_detail.php?id=<?php echo $data["contact_id"]; ?>">
                                <button type="button" class="btn btn-primary mx-1">詳細</button></a>
                                <a href="admin_contact_edit.php?id=<?php echo $data["contact_id"]; ?>"><button type="button" class="btn btn-secondary mx-1">編集</button></a>
                                <a href="admin_contact_delete.php?id=<?php echo $data["contact_id"]; ?>"><button type="button" class="btn btn-danger mx-1">削除</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>