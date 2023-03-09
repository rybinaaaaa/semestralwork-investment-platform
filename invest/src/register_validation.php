<?php
include_once 'database.php';

//remove the dangers
function clear_data($val): string
{
    $val = trim($val);
    return htmlspecialchars($val);
}

$email = empty($_POST['email']) ? "" : clear_data($_POST['email']);
$phone = empty($_POST['phone']) ? "" : clear_data($_POST['phone']);
$name = empty($_POST['name']) ? "" : clear_data($_POST['name']);
$surname = empty($_POST['surname']) ? "" : clear_data($_POST['surname']);
$date = empty($_POST['date']) ? "" : clear_data($_POST['date']);
$place = empty($_POST['place']) ? "" : clear_data($_POST['place']);
$second_password = empty($_POST['second_password']) ? "" : clear_data($_POST['second_password']);
$password = empty($_POST['password']) ? "" : clear_data($_POST['password']);
$date = $date ? clear_data($_POST["date"]) : "";

function check_date($date)
{
    $date = strtotime($date);
    $template = 60 * 60 * 24 * 365 * 18;
    return time() - $date >= $template;
}

function check_phone($phone)
{
    $template = '/[0-9]{6,}/';
    return preg_match($template, $phone);
}

$error = [];
$flag = 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($name) || strlen($name) >= 15) {
        $error['name'] = '
            <small class="primary_fieldset__error-message">
                Invalid name! Name must have from 3 to 15 chars!
            </small>';
        $flag = 1;
    }
    if (empty($surname) || strlen($surname) >= 15) {
        $error['surname'] = '
            <small class="primary_fieldset__error-message">
                Invalid surname! Surname must have from 3 to 15 chars!
            </small>';
        $flag = 1;
    }
    if (empty($date)) {
        $date = check_date($date) ? "true" : "false";
        $error['date'] = '
            <small class="primary_fieldset__error-message">
                You should enter the date of your birthday
                ' . $date . '
            </small>';
        $flag = 1;
    }
    if (!check_date($date)) {
        $error['date'] = '
            <small class="primary_fieldset__error-message">
                You should be at least 18 y.o
            </small>';
        $flag = 1;
    }
    if (!filter_var($email, FILTER_SANITIZE_EMAIL) || empty($email)) {
        $error['email'] = '
            <small class="primary_fieldset__error-message">
                Invalid email address!
            </small>';
        $flag = 1;
    }
    if (!is_unique($email)) {
        $error['email'] = '
            <small class="primary_fieldset__error-message">
                Email is already exists
            </small>';
        $flag = 1;
    }
    if ($second_password != $password) {
        $error['password'] = '
            <small class="primary_fieldset__error-message">
               Passwords must match!!
            </small>';
        $flag = 1;
    }
    if (strlen($password) < 8) {
        $error['password'] = '
            <small class="primary_fieldset__error-message">
              Password can not be shorter than 8 chars
            </small>';
        $flag = 1;
    }
    if (!check_phone($phone)) {
        $error['phone'] = '
            <small class="primary_fieldset__error-message">
              Incorrect phone number
            </small>';
        $flag = 1;
    }

    if (!is_unique($phone)) {
        $error['phone'] = '
            <small class="primary_fieldset__error-message">
              This number is already exist 
            </small>';
        $flag = 1;
    }

    if ($flag == 0) {
        $exists = log_in($phone, $password);
        if ($exists) {
            $id = $exists["user_id"];
            header("Location:id.php?id=$id");
        } else {
            $registered = register($name, $surname, $email, $place, $date, $password, $phone);
            if ($registered) {
                $id = log_in($email, $password)["user_id"];
                header("Location:id.php?id=$id");
            }
        }
    }
}