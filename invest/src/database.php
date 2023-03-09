<?php
session_start();
//config db
$server = 'localhost';
$login = 'rybinali';
$password = 'webove aplikace';
$name_db = 'rybinali';

//connect db
$database = new mysqli($server, $login, $password, $name_db);
if ($database->connect_error) {
    echo $database->connect_error;
}

//login db
function log_in($login, $password)
{
    global $database;

    $result = $database->query("SELECT * FROM user WHERE (email='$login' OR phone_number='$login')");

    if ($result) {
        $result = mysqli_fetch_assoc($result);
        $pass = $result["password"] ?? "";
        if (password_verify($password, $pass)) {
            $_SESSION["user_id"] = $result["user_id"];
            return $result;
        }
    }
    return false;
}

//register
function register($name, $surname, $email, $place, $date, $password, $phone): bool
{
    global $database;

    $password = password_hash($password, PASSWORD_DEFAULT);

    return $database->query("INSERT INTO `user`(`user_id`, `name`, `surname`, `email`, `place`, `date`, `password`, `phone_number`, `photo`) VALUES (NULL, '$name', '$surname', '$email', '$place', '$date', '$password', '$phone', NULL)");
}

//add idea to db
function add_idea($user_id, $theme, $description)
{
    global $database;

    return $database->query("INSERT INTO `idea`(`idea_id`, `theme`, `desription`, `owner_id`) VALUES (NULL, '$theme','$description','$user_id')");
}

//give you all ideas except one user
function get_ideas_except_user($user_id)
{
    global $database;

    $result = $database->query("SELECT * FROM idea WHERE owner_id != $user_id");

    return $result->fetch_all(MYSQLI_ASSOC);
}

//get ideas of user
function get_owner_ideas($user_id)
{
    global $database;

    $result = $database->query("SELECT * FROM idea WHERE owner_id = $user_id");

    if (!$result) {
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

//get user
function get_user($id)
{
    global $database;

    $result = $database->query("SELECT * FROM user WHERE user_id = $id");

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

//add like for user
function add_like($user_id, $idea_id)
{
    global $database;

    $result = $database->query("INSERT INTO `users_ideas`(`user_id`, `idea_id`) VALUES ('$user_id', '$idea_id')");
    if (!$result) {
        $result = $database->query("DELETE FROM users_ideas WHERE user_id = $user_id AND idea_id = $idea_id");
    }

    return $result;
}

//boolean "did user like this idea"
function is_liked($user_id, $idea_id)
{
    global $database;

    return mysqli_fetch_assoc($database->query("SELECT * FROM users_ideas WHERE user_id = $user_id AND idea_id = $idea_id"));
}

//get liked ideas by user
function get_liked_ideas($user_id)
{
    global $database;

    $sql = "SELECT idea.idea_id, idea.theme, idea.desription, idea.owner_id FROM user, idea, users_ideas WHERE users_ideas.user_id = user.user_id AND users_ideas.idea_id = idea.idea_id AND user.user_id = $user_id";
    $result = $database->query($sql);
    if (!$result) {
        return [];
    }
    return $result->fetch_all(MYSQLI_ASSOC);;
}

//boolean is data unique
function is_unique($data): bool
{
    global $database;

    $result = $database->query("SELECT * FROM user WHERE email = '$data' OR phone_number = '$data'");
    return !$result->num_rows;
}

//get information on request
function searchIdeas($query)
{
    global $database;

    $result = $database->query("SELECT * FROM idea WHERE theme LIKE '$query%'");

    return $result->fetch_all(MYSQLI_ASSOC);
}

//get idea by id
function get_idea($idea_id)
{
    global $database;

//    $result = $database->query("SELECT * FROM idea WHERE idea_id LIKE '$idea_id'");
    $result = $database->query("SELECT * FROM idea WHERE idea_id=$idea_id");

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

//This script appears to be a collection of functions used to interact with a MySQL database in order to handle user registration and login, as well as adding, retrieving and managing ideas, and likes on those ideas.
//
//The script starts by connecting to the MySQL database using the server, login, password, and name of the database.
//
//Then, it defines several functions to perform specific tasks:

//log_in: takes login and password as parameters and returns the user's information if the login and password match a record in the database, otherwise it returns false.
//register: takes name, surname, email, place, date, password, and phone as parameters, hashes the password and then insert this information into the user table of the database.
//add_idea: takes user_id, theme, and description as parameters and insert them into the idea table of the database.
//get_ideas_except_user: takes user_id as parameter and returns all ideas from the idea table of the database, except those of the specified user.
//get_owner_ideas: takes user_id as parameter and returns all ideas from the idea table of the database, of the specified user.
//get_user: takes user_id as parameter and returns all information of the specified user from the user table of the database.
//add_like: takes user_id, idea_id as parameters and insert a new record into the users_ideas table of the database, linking the specified user to the specified idea.
//is_liked: takes user_id, idea_id as parameters and returns true if the specified user liked the specified idea.
//get_liked_ideas: takes user_id as parameter and returns all ideas from the idea table of the database, that the specified user liked.
//like: takes idea_id, user_id as parameters and returns a string of html code representing the like button.
//create_card: takes owner_id, theme, description, idea_id, user_id as parameters and returns a string of html code representing a card displaying the information.
//changeColor: changes the color scheme of the website depending on the selected theme.


