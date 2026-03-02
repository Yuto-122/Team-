<?php
require_once __DIR__ . '/../functions/function.php';

// TODO: データ受け取り
if (!empty($_POST)) {
    if (!empty($_POST['category']) && !empty($_POST['link_id'])) {
        $category = $_POST['category'];
        $link_id = $_POST['link_id'];
        // DBに接続
        try {
            $db = db_connect();
            $sql = 'INSERT INTO faq_category (category, link_id, create_date) VALUES (:category, :link_id, now())';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':link_id', $link_id, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            exit('エラー: ' . $e->getMessage());
        }
    }
}

header('location:admin_faq_category.php');
exit();
