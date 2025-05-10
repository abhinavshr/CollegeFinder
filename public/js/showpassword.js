document.addEventListener("DOMContentLoaded", function () {
    let eyeIcon = document.getElementById("eye-icon");
    if (eyeIcon) {
        eyeIcon.addEventListener("click", function () {
            let passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.src = "/images/icons/eye-slash.png";
            } else {
                passwordField.type = "password";
                eyeIcon.src = "/images/icons/eye.png";
            }
        });
    } else {
        console.error("Eye icon not found!");
    }
});
