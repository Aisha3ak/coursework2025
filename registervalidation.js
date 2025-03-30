function checkValidations(event){
    user_password = document.getElementById('password').value;
    confirm_password = document.getElementById('confirm_password').value;

    if(user_password !== confirm_password){
        event.preventDefault();

    if(user_password !== confirm_password)
        {
            document.getElementById('userPasswordError').innerHTML = "Password does not match";
            document.getElementById('userPasswordError').style.color = "red";
            return false;
        }
    }
}