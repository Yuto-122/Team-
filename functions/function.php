<?php
require_once __DIR__ . "/../inc/db_info.php";

function debug_check($array){
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}

function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function db_connect(){
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}

function check_logined()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION["id"])) {
        header("location:login.php");
        exit();
    }
}

// Admin内のシステムメッセージの種類
enum Msg_Status
{
    case Success;
    case Warning;
    case Error;
}

// Admin内のシステムメッセージを登録
function set_admin_system_message($msg, $msg_status)
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION["msg"] = $msg;
    $_SESSION["msg_status"] = $msg_status;
}

// Admin内のシステムメッセージを削除
function unset_admin_system_message()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    unset($_SESSION["msg"]);
    unset($_SESSION["msg_status"]);
}
