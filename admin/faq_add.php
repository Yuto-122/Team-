<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

$id = $_GET["id"];

$db = db_connect();
$sql = "SELECT id,category FROM faq_category";
$stmt = $db->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>チーム王将 | FAQ - 新規登録</title>
</head>

<body>
    <?php include('admin-header.php');  ?>

    <main role="main" class="container" style="padding:60px 15px 0">
        <?php include('admin-system-message.php'); ?>
        <h1 class="my-5">FAQ - 新規登録</h1>
        <form action="faq_add_do.php" method="post" class="mb-3">
            <div class="mb-3">
                <label for="question" class="form-label">質問</label>
                <input type="text" name="question" id="question" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <label for="answer" class="form-label">回答</label>
                <input type="text" name="answer" id="answer" class="form-control" value="" required>
            </div>
            <div class="mb-3">
                <?php foreach ($categories as $category): ?>
                    <input type="radio" id="<?php echo $category["id"] ?>" name="type" value="<?php echo $category["id"] ?>" <?php echo $category["id"] === 1 ? "checked" : ""; ?>>
                    <label for="<?php echo $category["id"] ?>"><?php echo $category["category"] ?></label>
                <?php endforeach; ?>
            </div>
            <div class="mb-3">
                <input type="submit" value="登録" class="btn btn-primary">
                <a href="admin_faq.php" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </form>

    </main>
</body>

</html>