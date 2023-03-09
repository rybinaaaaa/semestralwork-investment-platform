<?php
include_once "../src/log_in_validation.php";

// theme color
$color = $_COOKIE["theme"] ?? "light";
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
<header class="container main_header">
	<div class="main_header__title_container">
		<h2>
			MAKE YOUR BUSINESS EASY WITH
		</h2>
		<h1>
			INVEST
		</h1>
	</div>
	<img src="../assets/png/business-man.png" alt="logo" />
</header>
<main class="container main">
	<div class="main__description">
		<div class="main__description__topic">
			<p>How does it work?</p>
		</div>
		<div class="main__description__subtopic">
			<p>Lorem ipsum dolor sit ame t, consectetuer adipiscing elit. Integer vulputate sem a nibh rutrum consequat.
				Fusce tellus. Integer vulputate sem a nibh rutrum consequat. Cum sociis natoque penatibus et magnis dis
				parturient montes, nascetur ridiculus mus. Sed vel lectus. Donec odio tempus molestie, porttitor ut,
				iaculis quis, sem. </p>
		</div>
	</div>
	<form class="main__form" action="index.php" method="post" id="main__form">
		<fieldset class="primary_fieldset">
			<legend>
				Join us!
			</legend>
			<label for="login">
				Email or your phone
			</label>
			<input type="text" id="login" placeholder="+78687686" name="username" value="<?=$username??""?>" class="<?= isset($error['login_error']) ? "incorrect" : null ?>"/>
			<label for="password">
				Password
			</label>
			<input type="password" id="password" name="password" class="<?= isset($error['login_error']) ? "incorrect" : null ?>"/>
            <?=$error["login_error"] ?? null?>
			<div class="main__form__btn_container">
				<button type="submit" class="primary_btn" id="submit_login">Login</button>
				<a href="register.php" class="primary_btn main__form__btn_container__login" id="submit_register">
					Register
				</a>
			</div>
		</fieldset>
	</form>
</main>
<footer class="footer container">
	<div class="footer__section">
		<p class="footer__section__title"> INVEST </p>
		<p class="footer__section__description">Lorem ipsum dolor sit ame t, consectetuer adipiscing elit.</p>
		<div class="footer__section__images">
			<a href="/">
				<img src="../assets/icons/twitter.svg" alt="twitter" />
			</a>
			<a href="/">
				<img src="../assets/icons/instagram.svg" alt="instagram" />
			</a>
			<a href="/">
				<img src="../assets/icons/linkedin.svg" alt="linkedin" />
			</a>
		</div>
	</div>
	<div class="footer__section">
		<p class="footer__section__title"> Contact </p>
		<div class="footer__section__description">
			<a href="tel:+732373027">tel: +732373027 </a>
			<a> 25, Navagio Zakynthos, Greece </a>
			<a href="mailto:info@invectico.com"> info@invectico.com </a>
		</div>
	</div>
</footer>
<script type="module" src="../src/loginValidace.js"></script>
</body>
</html>