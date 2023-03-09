<?php
include_once 'database.php';

//remove the dangers
function clear_data($val): string
{
    $val = trim($val);
    return htmlspecialchars($val);
}

$error = [];
$flag = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = clear_data($_POST['username']) ?? "";
    $password = clear_data($_POST['password']) ?? "";
    $exists = log_in($username, $password);
    if ($exists) {
        $id = $exists["user_id"];
        header("Location:id.php?id=$id");
    } else {
        $error["login_error"] = '
            <small class="primary_fieldset__error-message">
                Incorrect username or password            
            </small>';
    }
}
