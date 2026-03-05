<?php
require_once __DIR__ . "/../functions/function.php";

session_start();
if (isset($_SESSION["admin_session_id"])) {
    $_SESSION = array();
    session_destroy();

    set_admin_system_message(MsgContent::LOGOUT->value, MsgStatus::SUCCESS);
}

header("location:login.php");
exit();
