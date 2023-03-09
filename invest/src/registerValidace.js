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

const validace = {
    email: (email) => {
        const emailRegEx = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
        if (emailRegEx.test(email.value)) {
            deleteError(email)
            return true;
        }
        addError(email, "Incorrect email");
        return false;
    },
    name: (name) => {
        if (name.value.length >= 5) {
            deleteError(name);
            return true;
        }
        addError(name, "Your name is too short :)");
        return false;
    },
    password: (password) => {
        if (password.value.length >= 8) {
            deleteError(password)
            return true;
        }
        addError(password, "Password isn't strong");
        return false;
    },
    secondPassword: (password, secPassword) => {
        console.log(password.value, secPassword.value)
        if (password.value === secPassword.value) {
            deleteError(secPassword)
            return true;
        }
        addError(secPassword, "Passwords must match");
        return false;
    },
    date: (date) => {
        const reDate = /[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/;
        if (date.value.match(reDate)) {
            deleteError(date)
            return true;
        }

        addError(date, "Incorrect date");
        return false;
    },
    phone: (phone) => {
        const reDate = /[0-9]{6,}/;
        if (phone.value.match(reDate)) {
            deleteError(phone)
            return true;
        }

        addError(phone, "Incorrect phone number");
        return false;
    }
};

const email = document.getElementById('email')
const phone = document.getElementById('phone')
const name = document.getElementById('name')
const surname = document.getElementById('surname')
const password = document.getElementById('password')
const secPassword = document.getElementById('secondPassword')
const form = document.getElementById('register')
const date = document.getElementById('date')

let timeReg = 0;


name.addEventListener('keyup', (e) => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        validace.name(e.target);
    }, 250);
});

surname.addEventListener('keyup', (e) => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        validace.name(e.target);
    }, 250);
});

email.addEventListener('keyup', (e) => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        validace.email(e.target);
    }, 250);
});

date.addEventListener('keyup', (e) => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        validace.date(e.target);
    }, 250);
});

password.addEventListener('keyup', (e) => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        validace.password(e.target);
    }, 250);
});

secPassword.addEventListener('keyup', (e) => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        validace.secondPassword(password, e.target);
    }, 250);
});

phone.addEventListener('keyup', (e) => {
    if (timeReg) {
        clearTimeout(timeReg);
    }
    timeReg = setTimeout(() => {
        validace.phone(e.target);
    }, 250);
});

form.addEventListener("submit", (e) => {
    const {
        email: valEmail,
        name: valName,
        password: valPassword,
        secondPassword: valSecPass,
        phone: valPhone
    } = validace;
    if (!(valEmail(email) && valName(name) && valName(surname) && valPassword(password) && valSecPass(password, secPassword) && valPhone(phone))) {
        e.preventDefault();
    }
})

form.addEventListener("change", e => {
    const {email: valEmail, name: valName, password: valPassword, phone: valPhone} = validace;
    document.getElementById("registerSubmit").removeAttribute("disabled");
    if (!(valEmail(email) && valName(name) && valName(surname) && valPassword(password)) && valPhone(phone)) {
        document.getElementById("registerSubmit").setAttribute("disabled", "");
    }
})