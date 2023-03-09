<?php
include_once 'database.php';

//remove the dangers
function clear_data($val)
{
    if (!$val) {
        return "";
    }
    $val = trim($val);
    return htmlspecialchars($val);
}

//template for errors
function error_message($message)
{
    return "<small class='primary_fieldset__error-message'>" . $message .
        "</small>";
}

$theme = clear_data($_POST['theme'] ?? null);
$description = clear_data($_POST['description'] ?? null);

$flag = 0;
$error = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    token for csrf attack
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

    if (!$token || $token !== $_SESSION['token']) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
    exit;
    }

    if (strlen($theme) < 5) {
        $error['theme'] = error_message("Theme is too short!!! It can not be shorter than 5 chars");
        $flag = 1;
    }
    if (strlen($description) < 30) {
        $error['description'] = error_message("Description is too short!!! It can not be shorter than 30 chars");
        $flag = 1;
    }
    if (!$flag && $_SESSION['user_id']) {
        if (add_idea($_SESSION['user_id'], $theme, $description)) {
            header("Location:invests.php");
        };
    }
}