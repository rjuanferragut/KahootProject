<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function wrongToken(){
            var alertElement = document.getElementById('textAlertWrong');
            alertElement.style.display = "";
        }
        function correctToken(){
            var alertElement = document.getElementById('textAlertGood');
            alertElement.style.display = "";
        }
        function checkNewPassword(){
        var newPassword = document.getElementById('newPassword').value;
        var confirmNewPassword = document.getElementById('confirmNewPassword').value;
        var alertElement = document.getElementById('textAlertPass');
        var form = document.getElementById('passForm');

        if(newPassword != null && confirmNewPassword != null){

            if(newPassword != confirmNewPassword){
                // var classNewPassword = newPassword.getAttribute("class")+" is-invalid";
                // newPassword.removeAttribute('class');
                // newPassword.setAttribute("class", classNewPassword);
                alertElement.innerHTML = "Passwords doesn't match";
                alertElement.style.display = "";
            }else{
                form.submit();
                // alert("enviar Formulario");
            }
        }
    
    }
    </script>
    <title>Reset Password</title>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="#" class="navbar-brand">KAHOOT</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <form action="../../Login/index.html" method="Post">
                        <input type="submit" name="Login" value="Login" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <div class="col-lg-8 mx-auto mt-3" id="alert" >
        <div class="alert alert-danger alert-dismissable" id="textAlertWrong" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a>Invalid/Expire token.</div>
        <div class="alert alert-info alert-dismissable" id="textAlertGood" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a> Password change successfully.</div>
        <div class="alert alert-danger alert-dismissable" id="textAlertPass" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a>Passwords doesn't match.</div>
    </div>
    <?php

        if(isset($_POST['newPassword']) && isset($_POST['idUser'])){

            try{
                $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
            } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
            }
            
            $password =hash('sha256',$_POST['newPassword']);
            $idUser = $_POST['idUser'];

            $updatePassword = $pdo->prepare("UPDATE user SET password='".$password."' where id=".$idUser."");
            $updatePassword->execute();

            echo "<script>correctToken();</script>";

        }
        

        if(isset($_GET['token'])){

            $token=hash("sha256",$_GET['token']);

            echo $token."GET<br>";

            try{
                $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
            } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
            }

            $query = $pdo->prepare("SELECT * FROM user_token where token='".$token."'");
            $query->execute();
            $registre = $query->fetch();

            echo $registre['token']."dataBase<br>";


            if($registre['token'] == $token){
                $idUser =$registre['fk_id_user'];
                echo '<div class="mx-auto col-8">';
                echo '<form action="resetPassword.php" id="passForm" class="form-signin" method="post">';
                echo '<div class="form-group row">';
                echo '<label class="col-lg-3 col-form-label form-control-label">New password</label>';
                echo '<div class="col-lg-9">';
                echo '<input class="form-control" type="password" value="" id="newPassword" name="newPassword"/>';
                echo '<input type="hidden" name="idUser" value="'.$idUser.'">';
                echo '</div>';
                echo '</div>';
                echo '<div class="form-group row">';
                echo '<label class="col-lg-3 col-form-label form-control-label">Confirm new password</label>';
                echo '<div class="col-lg-9">';
                echo' <input class="form-control" type="password" value="" id="confirmNewPassword" name="confirmNewPassword"/>';
                echo '</div>';
                echo '</div>';
                echo '<input type="button" class="btn btn-primary" value="Save Changes" onclick="checkNewPassword()" />';
                echo '</form>';
                echo '</div>';
            }else{
                echo "else";
                echo '<div class="mx-auto col-8">';
            echo '<form id="passForm" class="form-signin" method="post">';
            echo '<fieldset disabled>';
            echo '<div class="form-group row">';
            echo '<label for="newPassword" class="col-lg-3 col-form-label form-control-label">New password</label>';
            echo '<div class="col-lg-6">';
            echo '<input class="form-control" type="password" value="" id="newPassword" name="newPassword"/>';
            echo '</div>';
            echo '</div>';
            echo '<div class="form-group row">';
            echo '<label class="col-lg-3 col-form-label form-control-label">Confirm new password</label>';
            echo '<div class="col-lg-6">';
            echo' <input class="form-control" type="password" value="" id="confirmNewPassword" name="confirmNewPassword"/>';
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';
            echo '<input type="button" class="btn btn-primary" value="Save Changes" onclick="checkNewPassword()" disabled/>';
            echo '</form>';
            echo '</div>';
            echo "<script>wrongToken();</script>";
            }
        }else{
            echo "out";
            echo '<div class="mx-auto col-8">';
            echo '<form id="passForm" class="form-signin" method="post">';
            echo '<fieldset disabled>';
            echo '<div class="form-group row">';
            echo '<label for="newPassword" class="col-lg-3 col-form-label form-control-label">New password</label>';
            echo '<div class="col-lg-6">';
            echo '<input class="form-control" type="password" value="" id="newPassword" name="newPassword"/>';
            echo '</div>';
            echo '</div>';
            echo '<div class="form-group row">';
            echo '<label class="col-lg-3 col-form-label form-control-label">Confirm new password</label>';
            echo '<div class="col-lg-6">';
            echo' <input class="form-control" type="password" value="" id="confirmNewPassword" name="confirmNewPassword"/>';
            echo '</div>';
            echo '</div>';
            echo '</fieldset>';
            echo '<input type="button" class="btn btn-primary" value="Save Changes" onclick="checkNewPassword()" disabled/>';
            echo '</form>';
            echo '</div>';
            echo "<script>wrongToken();</script>";
        }

    ?>
</body>
</html>