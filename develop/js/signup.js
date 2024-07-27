const form = document.getElementById('form');
const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const username = document.getElementById('username');
const email = document.getElementById('email');
const password = document.getElementById('password');


let erorrCount = 0;

const showError = (element, message) => {
    const errorMessage = element.nextElementSibling;
    errorMessage.innerText = message;
    element.classList.add('error');
    errorCount++;
}

const removeError = (element) => {
    const errorMessage = element.nextElementSibling;
    errorMessage.innerText = '';
    element.classList.remove('error');
    errorCount--;
}

const validEmail = emailValue => {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(emailValue);
}

const validPassword = passwordValue => {
    const passwordPattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return passwordPattern.test(passwordValue);
}

function validateFirstName() {
    const fnameValue = fname.value.trim();
    if (fnameValue == '') {
        showError(fname, 'First Name is required.');
    } else {
        removeError(fname);
    }
}

function validateLastName() {
    const lnameValue = lname.value.trim();
    if (lnameValue == '') {
        showError(lname, 'Last Name is required.');
    } else {
        removeError(lname);
    }
}


function validateEmail() {
    const emailValue = email.value.trim();
    if (emailValue == '') {
        showError(email, 'Email address is required');
    } else if (!validEmail(emailValue)) {
        showError(email, 'Email address is invalid. Enter format - xyz@xyz.xyz.');
    } else {
        removeError(email);
    }
}


function validateUsername() {
    const usernamevalue = username.value.trim();
    if (usernamevalue == '') {
        showError(username, 'Username is required.');
    } else if (usernamevalue.length > 20) {
        showError(username, 'Username must be within 20 characters.');
    } else {
        removeError(username);
    }
}


function validatePassword() {
    const passwordValue = password.value.trim();
    if (passwordValue == '') {
        showError(password, 'Password is required.');
    } else if (!validPassword(passwordValue)) {
        showError(password, 'Password must be at least 8 characters, and include uppercase, lowercase and number.');
    } else {
        removeError(password);
    }
}


function validate() {
    errorCount = 0; 
    validateEmail();
    validateUsername();
    validatePassword();
    validateFirstName();
    validateLastName();


    return errorCount == 0;
}

email.addEventListener('input', validateEmail);
username.addEventListener('input', validateUsername);
password.addEventListener('input', validatePassword);
fname.addEventListener('input', validateFirstName );
lname.addEventListener('input', validateLastName);

form.addEventListener('submit', e => {
if(!validate())
    e.preventDefault();
});

