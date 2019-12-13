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
        function wrongEmail(){
            var alertElement = document.getElementById('textAlertWrong');
            // alertElement.innerHTML = '<a class="panel-close close" data-dismiss="alert">×</a> Invalid Email address';
            alertElement.style.display = "";
        }
        function emailSend(){
            var alertElement = document.getElementById('textAlertGood');
            // alertElement.innerHTML = '<a class="panel-close close" data-dismiss="alert">×</a> Email send successfully';
            alertElement.style.display = "";
        }
    </script>
    <title>Forgot Password</title>
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
        <div class="alert alert-danger alert-dismissable" id="textAlertWrong" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a>Invalid Email address </div>
        <div class="alert alert-info alert-dismissable" id="textAlertGood" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a> Email send successfully</div>
    </div>
    <div class="col-lg-6 mx-auto">
    
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control " id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                <p>Enter your email so we can send you a recovery link</p>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php


        if(isset($_POST['email'])){

            $email = $_POST['email'];

            try{
                $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
            } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
            }
    
            $query = $pdo->prepare("SELECT id, count(*) as num FROM user where email='".$email."'");
            $query->execute();
            $registre = $query->fetch();

            if($registre['num']>0){
                $token = bin2hex(random_bytes(25));
                $encryptToken = hash("sha256", $token);
                $idUser = $registre['id'];

                $insertToken = $pdo->prepare("INSERT INTO user_token (token, expires, fk_id_user) VALUE ('".$encryptToken."', TIMESTAMPADD(HOUR, 2, current_timestamp()), '".$idUser."')");
                $insert = $insertToken->execute();

                if($insert){
                    echo "<script>console.log('dentro');</script>";
                    $msg = "Accede a este link para cambiar la contrasena, este solo tiene validez de un uso y caduca en 2 horas.";
                    mail($email, "Reset Password", $msg);
                }
                
                echo "<script>emailSend();</script>";
            }else{
                echo "<script>wrongEmail();</script>";
            }

        }     

    ?>
</body>
</html>