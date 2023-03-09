<?php
include_once '../src/components.php';
include_once '../src/idea_validation.php';
include_once '../src/database.php';

//checking if the user is logged in
$id = $_SESSION["user_id"] ?? null;
if (!$id) {
    header("Location:index.php");
}

//processing for adding / deleting a like
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $idea_id = $_GET["idea_id"] ?? null;
    $user_id = $_GET["user_id"] ?? null;


    if ($user_id and $idea_id) {
        add_like($user_id, $idea_id);
        header("Location:invests.php");
    }
}

//getting a search query
$search = $_GET["search"] ?? "";

//get ideas on demand
if (!empty($search)) {
    $ideas = searchIdeas($search);
} else {
    $ideas = get_ideas_except_user('0');
}

//creating pagination
$page_number = $_GET['page'] ?? 1;

$ideas_count = count($ideas);
$per_page = 7;
$pages_count = ceil($ideas_count / $per_page);

if (!in_array($page_number, range(1, $pages_count))) {
    $page_number = 1;
}

$ideas = array_slice($ideas, ($page_number - 1) * $per_page, $per_page);

//template for ideas
function create_card($owner_id = "", $theme = "", $description = "", $idea_id = "", $user_id = "")
{
    global $arrow_down, $id;

    $name = get_user($owner_id)["name"];
    $surname = get_user($owner_id)["surname"];

    return "<div class='bg-pr-card'>
                <a href='id.php?id=$owner_id' class='bg-pr-card__avatar'>
                <img alt='avatar' src='../assets/png/avatar.jpeg'/>
                </a>
                <a  href='idea.php?idea_id=$idea_id' class='bg-pr-card__text-content'>
                    <div class='bg-pr-card__text-content__row'>
                        <h4>
                            Author
                        </h4>
                        <p> $name $surname</p>
                    </div>
                    <div class='bg-pr-card__text-content__row'>
                        <h4>
                            Theme
                        </h4>
                        <p> $theme </p>
                    </div>
                    <div class='bg-pr-card__text-content__row description'>
                        <h4>
                            Description:
                        </h4>
                        <p>
                            $description
                        </p>
                        $arrow_down
                    </div>
                </a>
             <a class='like' href='invests.php?idea_id=" . $idea_id . "&user_id=" . $id . " ' data-idea_id='" . $idea_id . "' data-user_id=' " . $id ." '>
                " . like($idea_id, $user_id) . "
             </a>
        </div>";
}

//function to change theme
changeColor();

$color = $_COOKIE["theme"] ?? "light";
?>
<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.1, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/style.css"/>
    <link rel="stylesheet" href="../styles/root.css"/>
    <title>Document</title>
</head>
<body class="<?= $color == 'dark' ? 'dark-theme' : '' ?>">
<?= $header ?? null ?>
<main class="invests container">
    <form class="invests__filters">
        <fieldset class="primary_fieldset">
            <label for="search">
                Search
            </label>
            <input type="text" id="search" name="search" value="<?= $search ?>"/>
        </fieldset>
        <button type="submit" class="primary_btn">
            Search
        </button>
    </form>
    <div class="invests__projects">
        <?php
        foreach ($ideas as $idea) {
            echo create_card($idea["owner_id"], $idea["theme"], $idea["desription"], $idea["idea_id"], $id);
        }
        ?>
    </div>
    <a href="add_invest.php" class="add_invest_btn">
        +
    </a>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $pages_count; $i++) {
            $disabled = $i == $page_number;
            if ($disabled) {
                echo "<div class='pagination__number disabled'> $i </div>";
            } else {
                echo "<a class='pagination__number' href='?page=$i'> $i </a>";
            }
        }
        ?>
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