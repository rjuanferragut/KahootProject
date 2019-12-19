<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        function checkNewPassword(){
            var newPassword = document.getElementById('newPassword').value;
            var confirmNewPassword = document.getElementById('confirmNewPassword').value;
            var alertElement = document.getElementById('textAlertPass');
            var form = document.getElementById('signUpForm');

            if(newPassword != null && confirmNewPassword != null){

                if(newPassword != confirmNewPassword){
                    // var classNewPassword = newPassword.getAttribute("class")+" is-invalid";
                    // newPassword.removeAttribute('class');
                    // newPassword.setAttribute("class", classNewPassword);
                    // alertElement.innerHTML = "Passwords doesn't match";
                    alertElement.style.display = "";
                }else{
                    form.submit();
                    // alert("enviar Formulario");
                }
            }
        }
        function wrongEmail(){
            var alertElement = document.getElementById('textAlertWrong');
            alertElement.style.display = "";
        }
        function correctUser(){
            var alertElement = document.getElementById('textAlertGood');
            alertElement.style.display = "";
        }
    </script>
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="../Login/login.php" class="navbar-brand">KAHOOT</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <form action="../views/layouts/PINPlayer.html" method="Post">
                        <input type="submit" name="pinPlayer" value="Enter game PIN" class="btn btn-danger ">
                    </form>
                    <form action="../Login/login.php" method="Post">
                        <input type="submit" name="createQuiz" value="Login" class="btn btn-success ml-2">
                    </form>
                </div>
            </div>
        </nav>
    </div>

    <div class="col-lg-8 mx-auto mt-3" id="alert" >
        <div class="alert alert-danger alert-dismissable" id="textAlertWrong" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a>The email already exist</div>
        <div class="alert alert-info alert-dismissable" id="textAlertGood" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a> User created successfully.</div>
        <div class="alert alert-danger alert-dismissable" id="textAlertPass" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a>Passwords doesn't match.</div>
    </div>

    <div class="main pt-5">
        <!-- <h1>Sign up</h1> -->
        <div class="container">
            <div class="sign-up-content">
                <form method="POST" class="signup-form" id="signUpForm" action="index.php">
                    <h2 class="form-title">What type of user are you ?</h2>
                    <div class="form-radio">
                        <input type="radio" name="role" value="student" id="newbie" checked="checked" />
                        <label for="newbie">Student</label>
                        <input type="radio" name="role" value="teacher" id="average" />
                        <label for="average">Teacher</label>
                    </div>
                    <div class="form-textbox">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" />
                    </div>

                    <div class="form-textbox">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" />
                    </div>

                    <div class="form-textbox">
                        <label for="pass">Password</label>
                        <input type="password" name="password1" id="newPassword" />
                    </div>

                    <div class="form-textbox">
                        <label for="pass">Password</label>
                        <input type="password" name="password2" id="confirmNewPassword" />
                    </div>

                    <div class="form-textbox">
                        <label for="pass">Profile pic</label>
                        <input type="file" name="image" value="Search" accept="image/*">
                        <label for="file">Profile pic</label>
                        <!-- <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" /> -->
                        <!-- <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label> -->
                    </div>

                    <div class="form-textbox">
                        <input type="button" class="submit"  onclick="checkNewPassword()" value="Create account" />
                    </div>
                </form>

                <p class="loginhere">
                    Already have an account ?<a href="../Login/login.php" class="loginhere-link"> Log in</a>
                </p>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <?php

    include '../controllers/random_id_pin.php';

    if(isset($_POST['role']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])){

        $role = $_POST['role'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password1 = hash('sha256',$_POST['password1']);
        $password2 = hash('sha256',$_POST['password2']);

        if(isset($_POST['image'])){
            $image = $_POST['image'];
        }else{
            $image = "";
        }

        try{
            $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
        } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }

        $checkEmail = $pdo->prepare("SELECT count(*) as num FROM user WHERE email='".$email."'");
        $checkEmail->execute();
        $registre = $checkEmail->fetch();

        if($registre['num']>0){
            echo "<script>wrongEmail();</script>";
        }else{
            $idUser= randomID();
            $insertUser = $pdo->prepare("insert into user (id, email, name, password, role, state) value(".$idUser.",'".$email."', '".$name."', '".$password1."', '".$role."', 'disable')");
            $insertUser->execute();

            if($insertUser){
                $token = bin2hex(random_bytes(25));
                $encryptToken = hash("sha256", $token);

                $insertToken = $pdo->prepare("INSERT INTO user_token (token, expires, state, fk_id_user) VALUE ('".$encryptToken."', TIMESTAMPADD(HOUR, 2, current_timestamp()), 'unused', '".$idUser."')");
                $insert = $insertToken->execute();

                echo "<script>console.log('dentro');</script>";
                $url = "http://mateocasas.tk/KahootProject/views/activateAccount.php?token=".$token;
                $msg = "Accede a este link para aceptar los Tos y activar la cuenta, solo es valido durante las proximas 2 horas. ".$url;
                mail($email, "Activated account", $msg);

                echo "<script>console.log('fuera');</script>";
                echo "<script>correctUser();</script>";

            }

            // header("location: ../Login/index.html");
        }
    }

?>

</body>
</html>