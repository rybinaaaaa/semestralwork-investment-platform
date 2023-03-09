// hasError - checking if there is a neighbor element that shows an error
// deleteError - removes the element that signals an error
// addError - add an element indicating an error

const hasError = (element) => {
    return element.nextElementSibling.tagName === "SMALL"
}

function deleteError(element) {
    element.classList.remove('incorrect');
    if (hasError(element)) {
        element.nextElementSibling.remove()
    }
}

function addError(element, message) {
    element.classList.add('incorrect');
    if (!hasError(element)) {
        const error = document.createElement("small")
        error.className = "primary_fieldset__error-message"
        error.innerText = message
        element.parentNode.insertBefore(error, element.nextSibling)
    }
}

const login = document.getElementById('login')
const password = document.getElementById('password')
const form = document.getElementById('main__form')

let timeReg = 0;
let error = {password: false, login: false}

login.addEventListener('keyup', () => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        if (login.value.length <= 3) {
            addError(login, "Incorrect login")
            error.login = true
        } else {
            deleteError(login)
            error.login = false
        }
    }, 250);
});

password.addEventListener('keyup', () => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        if (password.value.length < 8) {
            addError(password, "Incorrect password")
            error.password = true
        } else {
            deleteError(password)
            error.password = false
        }
    }, 250);
});


form.addEventListener("change", () => {
    document.getElementById("submit_login").removeAttribute("disabled");
    if (error.login || error.password) {
        document.getElementById("submit_login").setAttribute("disabled", "");
    }
})

form.addEventListener("submit", e => {
    if (error.login || error.password) {
        e.preventDefault();
    }
})