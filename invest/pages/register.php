<?php
include_once "../src/register_validation.php";
include_once "../src/components.php";

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
    <link rel="stylesheet" href="../styles/root.css"/>
    <link rel="stylesheet" href="../styles/style.css"/>
    <title>Document</title>
</head>
<body class="<?= $color == 'dark' ? 'dark-theme' : '' ?>">
<?=$header ?? ""?>
<main class="register">
    <form id="register" method="post" action="register.php">
        <fieldset class="primary_fieldset">
            <legend>
                Registration
            </legend>
            <label for="email">
                Email *
            </label>
            <input value="<?= $email ?? "" ?>" type="email"
                   class="<?= isset($error['email']) ? "incorrect" : null ?>" id="email" autocomplete="off"
                   name="email"/>
            <?= $error['email'] ?? null ?>
            <label for="phone">
                Phone *
            </label>
            <input value="<?= $phone ?? "" ?>" class="<?= isset($error['phone']) ? "incorrect" : null ?>"
                   id="phone" autocomplete="off"
                   name="phone"/>
            <?= $error['phone'] ?? null ?>
            <label for="name">
                Name *
            </label>
            <input value="<?= $name ?? "" ?>" class="<?= isset($error['name']) ? "incorrect" : null ?>" id="name"
                   autocomplete="off" name="name"
            />
            <?= $error['name'] ?? null ?>
            <label for="surname">
                Surname *
            </label>
            <input value="<?= $surname ?? "" ?>" class="<?= isset($error['surname']) ? "incorrect" : null ?>"
                   id="surname"
                   autocomplete="off"
                   name="surname"/>
            <?= $error['surname'] ?? null ?>
            <label for="date">
                Date of birth *
            </label>
            <input type="date" value="<?= $date ?? "" ?>" class="<?= isset($error['date']) ? "incorrect" : null ?>"
                   id="date"
                   autocomplete="off"
                   name="date"/>
            <?= $error['date'] ?? null ?>
            <label for="place">
                Place of residence (extra field)
            </label>
            <input class="<?= isset($error['place']) ? "incorrect" : null ?>" id="place" name="place"
                   value="<?= $place ?? "" ?>"/>
            <?= $error['place'] ?? null ?>
            <label for="password">
                Password *
            </label>
            <input name="password" type="password" class="<?= isset($error['password']) ? "incorrect" : null ?>"
                   id="password"
            />
            <?= $error['password'] ?? null ?>
            <label for="secondPassword">
                Password again *
            </label>
            <input type="password" class="<?= isset($error['second_password']) ? "incorrect" : null ?>"
                   id="secondPassword" name="second_password"/>
            <?= $error['password'] ?? null ?>
            <button id="registerSubmit" type="submit" class="primary_btn"> Register</button>
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
<script type="module" src="../src/registerValidace.js"></script>
</body>
</html>