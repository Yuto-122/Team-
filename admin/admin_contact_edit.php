<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
check_logined();

// if (empty($_GET)) {
//     // GETが無かったら戻す
//     header("location:admin_contact.php");
//     exit();
// }

$id = $_GET["id"];

$db = db_connect();
$sql = "SELECT * FROM contact WHERE id=:id";
$sql2 = " SELECT id,status FROM support_status";

$stmt = $db->prepare($sql);
$stmt2 = $db->prepare($sql2);

$stmt->bindParam(":id", $id, PDO::PARAM_INT);


$stmt->execute();
$stmt2->execute();

$data = $stmt->fetch(PDO::FETCH_ASSOC);
$staData = $stmt2->fetchAll(PDO::FETCH_ASSOC);


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
        <?php include('admin-system-message.php');  ?>
        <h1 class="my-5">お問い合わせDB管理画面</h1>
        <form action="admin_contact_edit_do.php?id=<?php echo $data["id"]; ?>" method="post" class="mb-3">
            <div class="mb-3">
                <p><b>ID</b></p>
                <p><?php echo $data["id"] ?></p>
                <p><b>名前(フリガナ)</b></p>
                <p><?php echo h($data["name"]) ?><?php echo "（" . h($data["kana"]) . "）" ?></p>
                <p><b>メールアドレス</b></p>
                <p><?php echo h($data["email"]) ?></p>
                <p><b>お問い合わせ内容</b></p>
                <p><?php echo h($data["message"]) ?></p>
                <p><b>送信日時</b></p>
                <p><?php echo $data["receive_date"] ?></p>
                <p><b>対応状況</b></p>
                <?php foreach ($staData as $status): ?>
                    <input type="radio" id="<?php echo $status["id"]; ?>" name="status" value="<?php echo $status["id"]; ?>" <?php echo $status["id"] === $data["status"]  ? "checked" : "" ?>>
                    <label for="<?php echo $status["id"]; ?>"><?php echo $status["status"]; ?></label>
                <?php endforeach; ?>

            </div>
            <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
                <input type="hidden" name="date" value="<?php echo $data["update_date"]; ?>">
                <button type="submit" class="btn btn-primary">保存する</button>
                <a href="admin_contact_detail.php" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </form>

    </main>
</body>

</html>