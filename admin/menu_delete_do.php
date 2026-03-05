<?php
require_once __DIR__ . "/../functions/function.php";
check_logined();

if (empty($_GET)) {
    // GETが無かったら戻す
    set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
    header("location:admin_menu.php");
    exit();
}

$id = $_GET["id"];

try {
    $db = db_connect();
    $sql = "DELETE FROM menus WHERE id=:id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    set_admin_system_message(MsgContent::MENU_DELETE->value . $name, MsgStatus::SUCCESS);
    header('location:admin_menu.php');
    exit();
} catch (PDOException $e) {
    set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
    set_error_log($e->getMessage());
    header("location:menu_delete.php?id=" . $id);
    exit();
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_menu.php");
exit();
