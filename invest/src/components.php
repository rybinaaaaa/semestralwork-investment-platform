<?php
include_once "database.php";

// like component
function like($idea_id, $user_id)
{
    $active = is_liked($user_id, $idea_id) ? "active" : "";

    return '<svg data-idea_id="' . $idea_id . '" data-user_id="' . $user_id . '" class="like ' . $active . '" enable-background="new 0 0 471.701 471.701" version="1.1" viewBox="0 0 471.7 471.7" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">

	<path d="m433.6 67.001c-24.7-24.7-57.4-38.2-92.3-38.2s-67.7 13.6-92.4 38.3l-12.9 12.9-13.1-13.1c-24.7-24.7-57.6-38.4-92.5-38.4-34.8 0-67.6 13.6-92.2 38.2-24.7 24.7-38.3 57.5-38.2 92.4 0 34.9 13.7 67.6 38.4 92.3l187.8 187.8c2.6 2.6 6.1 4 9.5 4s6.9-1.3 9.5-3.9l188.2-187.5c24.7-24.7 38.3-57.5 38.3-92.4 0.1-34.9-13.4-67.7-38.1-92.4zm-19.2 165.7-178.7 178-178.3-178.3c-19.6-19.6-30.4-45.6-30.4-73.3s10.7-53.7 30.3-73.2c19.5-19.5 45.5-30.3 73.1-30.3 27.7 0 53.8 10.8 73.4 30.4l22.6 22.6c5.3 5.3 13.8 5.3 19.1 0l22.4-22.4c19.6-19.6 45.7-30.4 73.3-30.4s53.6 10.8 73.2 30.3c19.6 19.6 30.3 45.6 30.3 73.3 0.1 27.7-10.7 53.7-30.3 73.3z"/></svg>
';
}

// arrow component
$arrow_down = '<svg class="arrow-down" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M26.0002 1.80041C26.0002 2.2612 25.8587 2.72199 25.577 3.07298L14.0215 17.4727C13.4567 18.1764 12.5439 18.1764 11.9791 17.4727L0.423582 3.07298C-0.141194 2.3692 -0.141194 1.23162 0.423582 0.527838C0.988357 -0.175946 1.90124 -0.175946 2.46602 0.527838L13.0003 13.6549L23.5346 0.527838C24.0994 -0.175946 25.0123 -0.175946 25.577 0.527838C25.8587 0.87883 26.0002 1.33962 26.0002 1.80041Z" fill="black"/>
</svg>';

//theme change handling
function changeColor()
{
    if (!($_GET["theme"] ?? null)) {
    } elseif ($_GET["theme"] == "light") {
        setcookie("theme", "light");
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        setcookie("theme", "dark");
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

//header
$header = '
<header class="header container">
    <h2>
        INVESTICO
    </h2>
    <div>
        <a id="themeSwitcher" class="ThemeToggle ' . (($_COOKIE["theme"] ?? "light") == "light" ? "checked" : "") . '" href="?theme=' . (($_COOKIE["theme"] ?? "light") == "light" ? "dark" : "light") . '"></a>
        <a href="id.php">
            <img src="../assets/icons/user.svg" alt="home">
        </a>
    </div>
</header>
';
