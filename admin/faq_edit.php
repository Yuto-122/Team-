<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

$id = $_GET["id"];

$db = db_connect();
$sql = "SELECT * FROM faq WHERE id=:id";
$stmt = $db->prepare($sql);
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

$sql2 = "SELECT id,category FROM faq_category";
$stmt2 = $db->prepare($sql2);
$stmt2->execute();
$categories = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | FAQ - 編集</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php'); ?>
        <h1 class="my-5">FAQ - 編集</h1>
        <form action="faq_edit_do.php" method="post" class="mb-3">
            <div class="mb-3">
                <p>ID</p>
                <p><?php echo $data["id"] ?></p>
            </div>
            <div class="mb-3">
                <label for="question" class="form-label">質問</label>
                <input type="text" name="question" id="question" class="form-control" value="<?php echo $data["question"] ?>" required>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">回答</label>
                <input type="text" name="answer" id="answer" class="form-control" value="<?php echo $data["answer"] ?>" required>
            </div>
            <div class="mb-3">
                <?php foreach ($categories as $category): ?>
                    <input type="radio" id="<?php echo $category["id"] ?>" name="type" value="<?php echo $category["id"] ?>" <?php echo $category["id"] == $data["type"] ? "checked" : ""; ?>>
                    <label for="<?php echo $category["id"] ?>"><?php echo $category["category"] ?></label>
                <?php endforeach; ?>
            </div>
            <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
                <button type="submit" class="btn btn-primary">登録</button>
                <a href="admin_faq.php" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </form>

    </main>
</body>

</html>