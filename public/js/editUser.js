function checkNewPassword(){
    var newPassword = document.getElementById('newPassword').value;
    var confirmNewPassword = document.getElementById('confirmNewPassword').value;
    var alertElement = document.getElementById('textAlert');
    var form = document.getElementById('formEditUser');

    if(newPassword != null && confirmNewPassword != null){

        if(newPassword != confirmNewPassword){
            console.log(newPassword+" ; "+confirmNewPassword);
            // var classNewPassword = newPassword.getAttribute("class")+" is-invalid";
            // newPassword.removeAttribute('class');
            // newPassword.setAttribute("class", classNewPassword);
            alertElement.innerHTML = "Passwords doesn't match";
            alertElement.style.display = "block";
        }else{
            // form.submit();
            alert("enviar Formulario");
        }
    }
    
}