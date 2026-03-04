<?php
require_once __DIR__ . '/../functions/function.php';

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
            set_admin_system_message(MsgContent::FAQ_CATEGORY_ADD->value . $category, MsgStatus::SUCCESS);
            header('location:admin_faq_category.php');
            exit();
        } catch (PDOException $e) {
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            header('location:faq_category_add.php');
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header('location:admin_faq_category.php');
exit();
