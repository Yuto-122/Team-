<?php
require_once __DIR__ . "/../functions/function.php";

if (!empty($_POST)) {
    if (!empty($_POST["id"])) {
        $id = (int)$_POST["id"];

        try {
            $db = db_connect();


            //画像削除分　+++
            $sql02 = "SELECT * FROM info WHERE id=:id";
            $stmt02 = $db->prepare($sql02);
            $stmt02->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt02->execute();
            $result = $stmt02->fetch(PDO::FETCH_ASSOC);

            $file_path = '../img/news/' . $result['info_img'];
            //  var_dump($file_path);
            unlink($file_path);


            $sql = "DELETE FROM info WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            set_admin_system_message(MsgContent::INFO_DELETE->value, MsgStatus::SUCCESS);
            header('location:admin_info.php');
            exit();
        } catch (PDOException $e) {
            set_admin_system_message(MsgContent::COMMON_EXCEPTION->value . $e->getMessage(), MsgStatus::ERROR);
            set_error_log($e->getMessage());
            header("location:info_delete.php?id=" . $id);
            exit();
        }
    }
}

set_admin_system_message(MsgContent::COMMON_ERROR->value, MsgStatus::ERROR);
header("location:admin_info.php");
exit();
