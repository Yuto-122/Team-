<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

if (empty($_GET)) {
    // GETが無かったら戻す
    header("location:admin_contact.php");
    exit();
}

$id = $_GET["id"];

try {
    $db = db_connect();
    $sql = "DELETE FROM contact WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    set_admin_system_message(MsgContent::CONTACT_DELETE->value . $id, MsgStatus::SUCCESS);
    header('location:admin_contact.php');
    exit();
} catch (PDOException $e) {
    set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
    set_error_log($e->getMessage());
    header('location:admin_contact_edit.php?id=' . $id);
    exit();
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_contact.php");
exit();
