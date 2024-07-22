document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const signupForm = document.getElementById("signup-form");
    const loginBtn = document.getElementById("login-btn");
    const signupBtn = document.getElementById("signup-btn");
    const signupUsername = document.getElementById("signup-username");
    const signupPassword = document.getElementById("signup-password");
    const signupConfirmPassword = document.getElementById("signup-confirm-password");
    const signupError = document.getElementById("signup-error");

    loginBtn.addEventListener("click", function () {
        loginForm.classList.remove("hidden");
        signupForm.classList.add("hidden");
        loginBtn.classList.add("active");
        signupBtn.classList.remove("active");
    });

    signupBtn.addEventListener("click", function () {
        signupForm.classList.remove("hidden");
        loginForm.classList.add("hidden");
        signupBtn.classList.add("active");
        loginBtn.classList.remove("active");
    });

    signupForm.addEventListener("submit", function (event) {
        signupError.textContent = "";

        if (!/^[A-Za-z][A-Za-z0-9]*\d$/.test(signupUsername.value)) {
            event.preventDefault();
            signupError.textContent = "Username must start with a letter and end with a number.";
            return;
        }

        if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/.test(signupPassword.value)) {
            event.preventDefault();
            signupError.textContent = "Password must be at least 8 characters long, containing at least one uppercase letter, one lowercase letter, and one number.";
            return;
        }

        if (signupPassword.value !== signupConfirmPassword.value) {
            event.preventDefault();
            signupError.textContent = "Passwords do not match!";
            return;
        }
    });
});
