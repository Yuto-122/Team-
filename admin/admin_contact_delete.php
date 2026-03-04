<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

session_start();

if (empty($_GET)) {
    // GETが無かったら戻す
    header("location:admin_contact.php");
    exit();
}

$id = $_GET["id"];

$db = db_connect();
$sql = "SELECT contact.id AS contact_id,contact.name AS contact_name,contact.kana AS contact_kana,contact.email AS email,contact.message AS message,contact.receive_date AS receive_date,contact.update_date AS update_date,support_status.status AS status_name FROM contact INNER JOIN support_status ON contact.status = support_status.id WHERE contact.id=:id";


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
        <?php include('admin-system-message.php');  ?>
        <h1 class="my-5">お問い合わせDB管理画面</h1>
        <div class="mb-3">
            <p><b>ID</b></p>
            <p><?php echo $data["contact_id"] ?></p>
            <p><b>名前(フリガナ)</b></p>
            <p><?php echo h($data["contact_name"]) ?><?php echo "（" . $data["contact_kana"] . "）" ?></p>
            <p><b>メールアドレス</b></p>
            <p><?php echo h($data["email"]) ?></p>
            <p><b>お問い合わせ内容</b></p>
            <p><?php echo h($data["message"]) ?></p>
            <p><b>送信日時</b></p>
            <p><?php echo $data["receive_date"] ?></p>
            <p><b>対応状況</b></p>
            <p><?php echo $data["status_name"]; ?></p>

        </div>
        <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $data["contact_id"]; ?>">
            <a href="admin_contact_delete_confirm.php?id=<?php echo $data["contact_id"] ?>" class="btn btn-danger">削除する</a>
            <a href="admin_contact.php" class="btn btn-secondary">一覧に戻る</a>
        </div>
        </form>

    </main>
</body>

</html>