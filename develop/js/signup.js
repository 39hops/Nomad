// Names: Artin Azizi (041131883), Mohamed Dualeh (41137299), Raisa Rahman (041129634)
// Professor: Alemeseged Legesse
// File Name: signup.js
// Date: 8/11/2024
// Description: JS page for user form validation when signing up as a new user.

const form = document.getElementById("form");  // Get the form element
const fname = document.getElementById("fname");  // Get the first name input element
const lname = document.getElementById("lname");  // Get the last name input element
const username = document.getElementById("username");  // Get the username input element
const email = document.getElementById("email");  // Get the email input element
const password = document.getElementById("password");  // Get the password input element
const passwordRetype = document.getElementById("passwordretype");  // Get the re-type password input element

// Function to display error message and add error class
const showError = (element, message) => {
  const errorMessage = element.nextElementSibling;  // Get the next sibling element (error message)
  errorMessage.innerText = message;  // Set the error message text
  element.classList.add("error");  // Add error class to the input element
};

// Function to remove error message and class
const removeError = (element) => {
  const errorMessage = element.nextElementSibling;  // Get the next sibling element (error message)
  errorMessage.innerText = "";  // Clear the error message text
  element.classList.remove("error");  // Remove error class from the input element
};

// Function to validate email format
const validEmail = (emailValue) => {
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Define email pattern
  if (emailPattern.test(emailValue)) {  // Check if email matches the pattern
    return true;
  } else {
    return false;
  }
};

// Function to validate password strength
const validPassword = (passwordValue) => {
  const passwordPattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;  // Define password pattern
  return passwordPattern.test(passwordValue);  // Check if password matches the pattern
};

// Function to validate first name input
function validateFirstName() {
  const fnameValue = fname.value.trim();  // Get and trim the first name value
  if (fnameValue == "") {  // Check if the value is empty
    showError(fname, "First Name is required.");  // Show error message
    return false;
  } else {
    removeError(fname);  // Remove error message if valid
    return true;
  }
}

// Function to validate last name input
function validateLastName() {
  const lnameValue = lname.value.trim();  // Get and trim the last name value
  if (lnameValue == "") {  // Check if the value is empty
    showError(lname, "Last Name is required.");  // Show error message
    return false;
  } else {
    removeError(lname);  // Remove error message if valid
    return true;
  }
}

// Function to validate email input
function validateEmail() {
  const emailValue = email.value.trim();  // Get and trim the email value
  if (emailValue == "") {  // Check if the value is empty
    showError(email, "Email address is required");  // Show error message
    return false;
  } else if (!validEmail(emailValue)) {  // Check if email format is valid
    showError(email, "Email address is invalid. Enter format - xyz@xyz.xyz.");  // Show error message
    return false;
  } else {
    removeError(email);  // Remove error message if valid
    return true;
  }
}

// Function to validate username input
function validateUsername() {
  const usernamevalue = username.value.trim();  // Get and trim the username value
  if (usernamevalue == "") {  // Check if the value is empty
    showError(username, "Username is required.");  // Show error message
    return false;
  } else if (usernamevalue.length > 20) {  // Check if the username is within 20 characters
    showError(username, "Username must be within 20 characters.");  // Show error message
    return false;
  } else {
    removeError(username);  // Remove error message if valid
    return true;
  }
}

// Function to validate password input
function validatePassword() {
  const passwordValue = password.value.trim();  // Get and trim the password value
  if (passwordValue == "") {  // Check if the value is empty
    showError(password, "Password is required.");  // Show error message
    return false;
  } else if (!validPassword(passwordValue)) {  // Check if the password meets the strength criteria
    showError(
      password,
      "Password must be at least 8 characters, and include uppercase, lowercase and number."  // Show error message
    );
    return false;
  } else {
    removeError(password);  // Remove error message if valid
    return true;
  }
}

// Function to validate re-typed password input
function validateRetypedPassword() {
  const passwordRetypeValue = passwordRetype.value.trim();  // Get and trim the re-typed password value
  if (passwordRetype.value == "") {  // Check if the value is empty
    showError(passwordRetype, "Re-type password. ");  // Show error message
    return false;
  } else if (passwordRetypeValue !== password.value) {  // Check if passwords match
    showError(passwordRetype, "Passwords do not match.");  // Show error message
    return false;
  } else {
    removeError(passwordRetype);  // Remove error message if valid
    return true;
  }
}

// Add event listeners for input fields to validate on input
email.addEventListener("input", validateEmail);
username.addEventListener("input", validateUsername);
password.addEventListener("input", validatePassword);
fname.addEventListener("input", validateFirstName);
lname.addEventListener("input", validateLastName);
passwordRetype.addEventListener("input", validateRetypedPassword);

// Add event listener for form submission
form.addEventListener("submit", (e) => {
  e.preventDefault();  // Prevent the default form submission
  let checkEmail = validateEmail();  // Validate email
  let checkUsername = validateUsername();  // Validate username
  let checkPassword = validatePassword();  // Validate password
  let checkFirstName = validateFirstName();  // Validate first name
  let checkLastName = validateLastName();  // Validate last name
  let checkRetypedPassword = validateRetypedPassword();  // Validate re-typed password
  if (
    checkEmail &&
    checkUsername &&
    checkPassword &&
    checkFirstName &&
    checkLastName &&
    checkRetypedPassword === true  // Check if all validations passed
  ) {
    document.forms["form"].submit();  // Submit the form if all validations are successful
  }
});
