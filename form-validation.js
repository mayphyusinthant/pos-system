// Check input length
function validateLetter(input) {
  var letters = /^[A-Za-z\s]+$/;
  if (!input.value.match(letters)) {
    input.setCustomValidity(
      "Required Field : Input should not contain any number or special characters. "
    );
  } else {
    input.setCustomValidity("");
  }
  return true;
}

// Check input length
function validateNum(input) {
  if (isNaN(input.value)) {
    input.setCustomValidity("Input should be numbers only.");
  } else {
    input.setCustomValidity("");
  }

  return true;
}
