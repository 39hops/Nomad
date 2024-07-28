const form = document.getElementById("form");
const fname = document.getElementById("fname");
const lname = document.getElementById("lname");
const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");

const showError = (element, message) => {
  const errorMessage = element.nextElementSibling;
  errorMessage.innerText = message;
  element.classList.add("error");
};

const removeError = (element) => {
  const errorMessage = element.nextElementSibling;
  errorMessage.innerText = "";
  element.classList.remove("error");
};

const validEmail = (emailValue) => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (emailPattern.test(emailValue)) {
    return true;
  } else {
    return false;
  }
};

const validPassword = (passwordValue) => {
  const passwordPattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  return passwordPattern.test(passwordValue);
};

function validateFirstName() {
  const fnameValue = fname.value.trim();
  if (fnameValue == "") {
    showError(fname, "First Name is required.");
    return false;
  } else {
    removeError(fname);
    return true;
  }
}

function validateLastName() {
  const lnameValue = lname.value.trim();
  if (lnameValue == "") {
    showError(lname, "Last Name is required.");
    return false;
  } else {
    removeError(lname);
    return true;
  }
}

function validateEmail() {
  const emailValue = email.value.trim();
  if (emailValue == "") {
    showError(email, "Email address is required");
    return false;
  } else if (!validEmail(emailValue)) {
    showError(email, "Email address is invalid. Enter format - xyz@xyz.xyz.");
    return false;
  } else {
    removeError(email);
    return true;
  }
}

function validateUsername() {
  const usernamevalue = username.value.trim();
  if (usernamevalue == "") {
    showError(username, "Username is required.");
    return false;
  } else if (usernamevalue.length > 20) {
    showError(username, "Username must be within 20 characters.");
    return false;
  } else {
    removeError(username);
    return true;
  }
}

function validatePassword() {
  const passwordValue = password.value.trim();
  if (passwordValue == "") {
    showError(password, "Password is required.");
    return false;
  } else if (!validPassword(passwordValue)) {
    showError(
      password,
      "Password must be at least 8 characters, and include uppercase, lowercase and number."
    );
    return false;
  } else {
    removeError(password);
    return true;
  }
}

email.addEventListener("input", validateEmail);
username.addEventListener("input", validateUsername);
password.addEventListener("input", validatePassword);
fname.addEventListener("input", validateFirstName);
lname.addEventListener("input", validateLastName);

form.addEventListener("submit", (e) => {
  e.preventDefault();
  let checkEmail = validateEmail();
  let checkUsername = validateUsername();
  let checkPassword = validatePassword();
  let checkFirstName = validateFirstName();
  let checkLastName = validateLastName();
  if (
    checkEmail &&
    checkUsername &&
    checkPassword &&
    checkFirstName &&
    checkLastName === true
  ) {
    document.forms["form"].submit();
  }
});
