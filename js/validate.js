function validate() {
    var password = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    if (password.length < 8 || password2.length < 8) {
        alert("Password should be at least 8 characters long!");
        return false;
    }
    return true;
}