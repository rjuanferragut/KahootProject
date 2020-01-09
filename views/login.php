<?php
	session_start();
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
			$_SESSION['role'] = $row['role'];

			echo "<div class='alert alert-success mt-4' role='alert'><strong>Welcome!</strong> ".$row['name']."
			</div>";

			header("location: ../views/layouts/homePage.php");

		}elseif($password ==$hash && $row['state'] == "disable"){
			echo "<script>accountDisable();</script>";
		}else{
			echo "<script>wrongEmailPassword();</script>";
		}
	}


?>
