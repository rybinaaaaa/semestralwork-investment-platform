let checkbox = document.getElementById('themeSwitcher');

//get theme from coockies
function getTheme(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : "light"
}

//eventListener on Theme Switcher
checkbox.addEventListener('click', (e) => {
    e.preventDefault();
    const body = document.body;
    let theme = getTheme("theme") === "light" ? "dark" : "light"
    document.cookie = `theme=${theme}`
    body.classList.toggle('dark-theme');
    checkbox.classList.toggle('checked');
});


// This JavaScript code is setting up a theme switcher on a website. It starts by getting a reference to a checkbox element with an id of "themeSwitcher" using document.getElementById().
//
// It then defines a function called getTheme() which takes in a name parameter. This function uses the match() method to check if a cookie with the specified name exists, and if so, it returns the value of that cookie. If no cookie is found, it returns "light" as the default theme.
//
// The code then adds an event listener to the checkbox element, which listens for a click event. When the checkbox is clicked, the event listener calls a callback function which prevents the default behavior, and then uses the getTheme() function to check the current theme. If the current theme is "light", it sets the theme to "dark", otherwise it sets the theme to "light". Then it updates the cookie with the new theme and toggles the class "dark-theme" on the body element and toggles the class 'checked' on the checkbox.