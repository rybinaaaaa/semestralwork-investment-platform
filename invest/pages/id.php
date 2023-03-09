<?php
include_once '../src/components.php';
include_once '../src/database.php';

$own_id = $_SESSION["user_id"] ?? null;
$id = $_GET['id'] ?? $own_id;
$option = $_GET['option'] ?? 'own';

//checking if the user is logged in
if (!$own_id) {
    header("Location:index.php");
}

//function to change theme
changeColor();

$color = $_COOKIE["theme"] ?? "light";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $idea_id = $_GET["idea_id"] ?? null;
    $user_id = $_GET["user_id"] ?? null;

    if ($user_id and $idea_id) {
        add_like($user_id, $idea_id);
        header("Location:id.php?id=$id");
    }
}

[
    "name" => $name,
    "surname" => $surname,
    "place" => $place,
    "date" => $date,
    "email" => $email,
    "phone_number" => $phone
] = get_user($id);

if (!$name) {
    header("Location:id.php?id=$own_id");
}

$page_number = $_GET['page'] ?? 1;

$ideas = $option == "liked" ? get_liked_ideas($id) : get_owner_ideas($id);
$ideas_count = count($ideas);
$per_page = 3;
$pages_count = ceil($ideas_count / $per_page);

if (!in_array($page_number, range(1, $pages_count))) {
    $page_number = 1;
}

$ideas = array_slice($ideas, ($page_number - 1) * $per_page, $per_page);

function create_idea($idea)
{
    global $own_id;
    $idea_id = $idea["idea_id"];
    $title = $idea["theme"];
    $description = $idea["desription"];
    $like = like($idea_id, $own_id);
    return '
        <ul class="sm_idea_card">
            <li class="sm_idea_card__title">
                <div class="jc-flex-container">
                    <p>' . $title . '</p>
                    <a class="like" href="?idea_id=' . $idea_id . '&user_id=' . $own_id . '" data-idea_id="' . $idea_id . '" data-user_id="' . $own_id . '">
                   ' . $like . '
                   </a>
                </div>
                <ul class="sm_idea_card__subtitle">
                    <li class="jc-flex-container">
                        ' . $description . '
                    </li>
                </ul>
            </li>
        </ul>  ';
}

?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.1, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/root.css">
    <title>Document</title>
</head>
<body class="<?= $color == 'dark' ? 'dark-theme' : '' ?>">
<?= $header ?? null ?>
<main class="profile container">
    <div class="profile__title_container">
        <h1>
            <?= "$name" . " $surname" ?>
        </h1>
        <!--        <button id="edit">-->
        <!--            <img src="../assets/icons/edit.svg" alt="edit"/>-->
        <!--        </button>-->
    </div>
    <div class="profile__user_info">
        <!--	аватар-->
        <img class="profile__avatar" src="../assets/png/avatar.jpeg" alt="avatar"/>
        <!--	инфо аватара-->
        <ul class="profile__info">
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
    <!--	идеи-->
    <div class="profile__ideas">
        <div class="profile__ideas__switcher">
            <?php
            if ($option == "liked") {
                echo '
                 <div class="primary_btn disabled">
                Liked ideas
                </div>
                <a href="?id=' . $id . '&option=own" id="switch_own" class="primary_btn">
                Own ideas
                </a>
                ';
            } else {
                echo '
                <a href="?id=' . $id . '&option=liked" id="switch_likes" class="primary_btn">
                Liked ideas
                </a>
                <div class="primary_btn disabled">
                Own ideas
                </div>
                ';
            }
            ?>
        </div>
        <?php
        if ($ideas) {
            foreach ($ideas as $idea) {
                echo create_idea($idea);
            }
        } else {
            echo '<h2> Here is no ideas :(</h2>';
        }
        ?>

        <div class="pagination">
            <?php
            for ($i = 1; $i <= $pages_count; $i++) {
                $disabled = $i == $page_number;
                if ($disabled) {
                    echo "<div class='pagination__number disabled'> $i </div>";
                } else {
                    echo "<a class='pagination__number' href='?id=$id&page=$i&option=$option'> $i </a>";
                }
            }
            ?>
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