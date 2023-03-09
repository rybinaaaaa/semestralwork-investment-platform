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

const theme = document.getElementById("theme")
const description = document.getElementById("description")

const form = document.getElementById('add_invest_form')

let timeReg = 0;
let error = {theme: false, description: false}

theme.addEventListener('keyup', () => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        if (theme.value.length <= 5) {
            addError(theme, "Theme must be longer")
            error.theme = true
        } else {
            deleteError(theme)
            error.theme = false
        }
    }, 250);
});

description.addEventListener('keyup', () => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        if (description.value.length <= 35) {
            addError(description, "Description must be longer")
            error.description = true
        } else {
            deleteError(description)
            error.description = false
        }
    }, 250);
});


form.addEventListener("change", () => {
    document.getElementById("idea_submit").removeAttribute("disabled");
    if (error.theme || error.description) {
        document.getElementById("idea_submit").setAttribute("disabled", "");
    }
})

form.addEventListener("submit", e => {
    if (error.theme || error.description) {
        e.preventDefault();
    }
})