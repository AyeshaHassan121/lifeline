document.addEventListener("DOMContentLoaded", function () {
    var form = document.querySelector("form");
    var passwords = document.querySelectorAll('input[type="password"]');

    // Show password checkbox
    if (passwords.length > 0) {
        var label = document.createElement("label");
        label.className = "show-pass";
        label.innerHTML = '<input type="checkbox"> Show password';
        passwords[passwords.length - 1].insertAdjacentElement("afterend", label);

        label.querySelector("input").addEventListener("change", function () {
            var show = this.checked;
            passwords.forEach(function (p) {
                p.type = show ? "text" : "password";
            });
        });
    }

    // Simple checks before the signup form is sent
    var confirmField = document.querySelector('input[name="confirm_password"]');
    if (form && confirmField) {
        form.addEventListener("submit", function (e) {
            var pass = document.querySelector('input[name="password"]').value;
            if (pass.length < 8) {
                alert("Password must contain at least 8 characters.");
                e.preventDefault();
            } else if (pass !== confirmField.value) {
                alert("Passwords do not match.");
                e.preventDefault();
            }
        });
    }
});
