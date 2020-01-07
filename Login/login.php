<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script>
		function wrongEmailPassword(){
            var alertElement = document.getElementById('textAlertWrong');
            alertElement.style.display = "";
        }
        function accountDisable(){
            var alertElement = document.getElementById('textAlertAccount');
            alertElement.style.display = "";
        }
	</script>

</head>
<body>
<?php ob_start();  session_start();?>
	<div>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<a href="index.html" class="navbar-brand">KAHOOT</a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<div class="navbar-nav ml-auto">
					<form action="../views/layouts/PINPlayer.html" method="Post">
						<input type="submit" name="pinPlayer" value="Enter game PIN" class="btn btn-danger mr-2">
					</form>
					<form action="../signUp/index.html" method="Post">
						<input type="submit" name="pinPlayer" value="Sign up" class="btn btn-success">
					</form>	
				</div>
			</div>
		</nav>
	</div>	
	<div class="limiter">
		<div class="mx-auto pt-3" id="alert" style="background-color: #e9faff">
			<div class="alert alert-danger alert-dismissable col-lg-8 mx-auto mb-0" id="textAlertWrong" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a>Email/password incorrect.</div>
			<div class="alert alert-danger alert-dismissable col-lg-8 mx-auto mb-0"  id="textAlertAccount" style="display:none"> <a class="panel-close close" data-dismiss="alert">×</a>The account is disabled, please check your email to activated.</div>
		</div>
		<div class="container-login100">
				
				<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50 ">
					<form class="login100-form validate-form" action="login.php" method="post">
						<span class="login100-form-title p-b-33">
							Account Login
						</span>

						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
							<input class="input100" type="text" name="email" placeholder="Email">
							<span class="focus-input100-1"></span>
							<span class="focus-input100-2"></span>
						</div>

						<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
							<input class="input100" type="password" name="password" placeholder="Password">
							<span class="focus-input100-1"></span>
							<span class="focus-input100-2"></span>
						</div>

						<div class="container-login100-form-btn m-t-20">
							<input type="submit" value="login" class="login100-form-btn">
						</div>

						<div class="text-center p-t-45 p-b-4">
							<span class="txt1">
								Forgot
							</span>

							<a href="../views/layouts/forgotPassword.php" class="txt2 hov1">
								Password?
							</a>
						</div>

						<div class="text-center">
							<span class="txt1">
								Create an account?
							</span>

							<a href="../signUp/index.php" class="txt2 hov1">
								Sign up
							</a>
						</div>
					</form>
				</div>
		</div>
	</div>
<?php
		// Connection info. file

		include '../controllers/conn.php';

		// Connection variables
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// data sent from form login.html
		// password encryted in sha256

		if(isset($_POST['logOut'])){
			session_destroy();
		}

		if(isset($_POST['email']) && isset($_POST['password'])){

			$email = $_POST['email'];
			$password = hash('sha256',$_POST['password']);

			// Query sent to database
			$consulta ="SELECT * FROM user WHERE email = '$email'";
			$result = mysqli_query($conn, $consulta);

			// Variable $row hold the result of the query
			$row = mysqli_fetch_assoc($result);

			// Variable $hash hold the password hash on database
			$hash = $row['password'];

			if ($password ==$hash && $row['state'] == "active") {

				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $row['name'];
				$_SESSION['idUser'] = $row['id'];
				
				header("location: ../views/layouts/homePage.php");

			}elseif($password ==$hash && $row['state'] == "disable"){
				echo "<script>accountDisable();</script>";
			}else{
				echo "<script>wrongEmailPassword();</script>";
			}
		}
?>

	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>