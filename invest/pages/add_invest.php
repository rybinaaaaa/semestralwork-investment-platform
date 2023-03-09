<?php
include_once '../src/idea_validation.php';
include_once '../src/components.php';

$_SESSION['token'] = md5(uniqid(mt_rand(), true));

//checking if the user is logged in
$id = $_SESSION["user_id"] ?? null;
if (!$id) {
    header("Location:index.php");
}

//function to change theme
changeColor();

$color = $_COOKIE["theme"] ?? "light";
?>

<!doctype html>
<html lang="en">
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
<?=$header ?? ""?>
<main class="add_invest">
    <form id="add_invest_form" method="post" action="add_invest.php">
        <fieldset class="primary_fieldset">
            <legend> Add new idea</legend>
            <label for="theme"> theme </label>
            <input id="theme" name="theme" value="<?= $theme ?? "" ?>"/>
            <?= $error['theme'] ?? null ?>
            <label for="description"> description </label>
            <textarea id="description" name="description"> <?= $description ?? "" ?> </textarea>
            <?= $error['description'] ?? null ?>
<!--            token for csrf attack-->
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
            <button type="submit" class="primary_btn" id="idea_submit"> Send!</button>
        </fieldset>
    </form>
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
<script type="module" src="../src/ideaValidace.js"></script>
</body>
</html>