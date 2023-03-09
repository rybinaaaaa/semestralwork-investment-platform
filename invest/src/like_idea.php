<?php
include_once("../src/database.php");

//decode for ajax technology
$input = file_get_contents("php://input");
$decode=json_decode($input,true);
$idea_id = $decode["idea_id"];
$user_id = $decode["user_id"];
add_like($user_id, $idea_id);

//processing of data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idea_id = $_POST["idea_id"];
    $user_id = $_POST["user_id"];

    add_like($user_id, $idea_id);
}