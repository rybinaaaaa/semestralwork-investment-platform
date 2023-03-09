<?php
include_once '../src/components.php';
include_once '../src/database.php';

$idea_id = $_GET["idea_id"] ?? null;
$id = $_SESSION["user_id"] ?? null;

//checking if the user is logged in
if (!$id) {
    header("Location: index.php");
}

if (!$idea_id) {
    header("Location: id.php");
}

$idea = get_idea($idea_id);

if (!$idea) {
    header("Location: id.php");
}

[
    "theme" => $theme,
    "desription" => $description,
    "owner_id" => $user_id
] = $idea;

[
    "name" => $name,
    "surname" => $surname,
    "place" => $place,
    "date" => $date,
    "email" => $email,
    "phone_number" => $phone
] = get_user($user_id);

//function to change theme
changeColor();

$color = $_COOKIE["theme"] ?? "light";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $idea_id = $_GET["idea_id"] ?? null;
    $user_id = $_GET["user_id"] ?? null;


    if ($user_id and $idea_id) {
        add_like($user_id, $idea_id);
        header("Location:idea.php?idea_id=$idea_id");
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.1, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/root.css">
    <title>Document</title>
</head>
<body class="main_grid <?= $color == 'dark' ? 'dark-theme' : '' ?>">
<?= $header ?? null ?>
<main class="idea container">
    <!--    <div class="profile__title_container">-->
    <!---->
    <!--        <button id="edit">-->
    <!--            <img src="../assets/icons/edit.svg" alt="edit"/>-->
    <!--        </button>-->
    <!--    </div>-->
    <div class="idea__author">
        <!--	аватар-->
        <img class="idea__author__avatar" src="../assets/png/avatar.jpeg" alt="avatar"/>
        <a class="idea__author__title" href="id.php?id=<?= $user_id ?>">
            <h2>
                <?= $name . " " . $surname ?>
            </h2>
        </a>
        <!--	инфо аватара-->
        <ul class="idea__author__info">
            <li id="birthday">
                <img src="../assets/icons/calendar.svg" alt="birthday">
                <p>
                    <?= $date ?>
                </p>
            </li>
            <?php
            if (!empty($place)) {
                echo "<li id='adress'>
                    <img src='../assets/icons/map.svg' alt='adress'>
                    <p>
                       $place
                    </p>
                </li>";
            }
            ?>
            <li id="mail">
                <img src="../assets/icons/mail.svg" alt="mail">
                <p>
                    <?= $email ?>
                </p>
            </li>
            <li id="phone">
                <img src="../assets/icons/phone.svg" alt="phone">
                <p>
                    <?= $phone ?>
                </p>
            </li>
        </ul>
    </div>
    <div class="idea__info">
        <h1 class="idea__info__theme">
            <?= $theme ?>
            <a class='like' href='idea.php?idea_id=<?= $idea_id ?>&user_id=<?= $id ?>' data-idea_id="<?=$idea_id?>" data-user_id="<?=$id?>">
                <?= like($idea_id, $id) ?>
            </a>
        </h1>
        <div class="idea__info__description">
            <p>
                <?= $description ?>
            </p>
        </div>
        <a href="invests.php" class="long_btn primary_btn">
            <p> See more ideas </p>
            <img src="../assets/icons/arrow.svg" alt="arrow">
        </a>
    </div>
</main>
<footer class="footer container">
    <div class="footer__section">
        <p class="footer_section__title"> INVESTICO </p>
        <p class="footer_section__description">Lorem ipsum dolor sit ame t, consectetuer adipiscing elit.</p>
        <div class="footer__section__images">
            <a href="/">
                <img src="../assets/icons/twitter.svg" alt="twitter"/>
            </a>
            <a href="/">
                <img src="../assets/icons/instagram.svg" alt="instagram"/>
            </a>
            <a href="/">
                <img src="../assets/icons/linkedin.svg" alt="linkedin"/>
            </a>
        </div>
    </div>
    <div class="footer__section">
        <p class="footer_section__title"> Contact </p>
        <p class="footer_section__description">
            tel: +732373027 <br>
            25, Navagio Zakynthos, Greece <br>
            info@invectico.com <br>
        </p>
    </div>
</footer>
<script type="module" src="../src/index.js"></script>
<script type="module" src="../src/likeIdea.js"></script>
</body>
</html>