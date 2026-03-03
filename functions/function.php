<?php
require_once __DIR__ . "/../inc/db_info.php";

function debug_check($array)
{
    echo "<pre>";
    var_dump($array);
    echo "</pre>";
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function db_connect()
{
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
enum MsgStatus
{
    case SUCCESS;
    case WARNING;
    case ERROR;
}

// メッセージ本文
enum MsgContent: string
{
    // 共通文言
    case COMMON_ERROR = "問題が発生しました。<br>";
    case COMMON_EXCEPTION = "例外が発生しました。<br>";
    case COMMON_USED = "すでに使用されています。<br>";

    case USER_PREG_MATCH = "ユーザー名の書式は 半角英数4文字以上 にしてください";
    case USER_ADD = "ユーザーを追加しました。<br>ユーザー名: ";
    case USER_DELETE = "ユーザーを削除しました。";
    case USER_EDIT = "ユーザーを編集しました。<br>ユーザー名: ";
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
