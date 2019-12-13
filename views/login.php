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
			$email = $_POST['email'];
			$password = hash('sha256',$_POST['password']);

			// Query sent to database
			$consulta ="SELECT id, email, password, name FROM user WHERE email = '$email'";
			$result = mysqli_query($conn, $consulta);

			// Variable $row hold the result of the query
			$row = mysqli_fetch_assoc($result);

			// Variable $hash hold the password hash on database
			$hash = $row['password'];

			/*
			password_Verify() function verify if the password entered by the user
			match the password hash on the database. If everything is OK the session
			is created for one minute. Change 1 on $_SESSION[start] to 5 for a 5 minutes session.
			*/

			// if ($password ==$hash) {
			//
			// 	$_SESSION['loggedin'] = true;
			// 	$_SESSION['name'] = $row['name'];
			// 	$_SESSION['idUser'] = $row['id'];
			// 	// $_SESSION['start'] = time();
			// 	//$_SESSION['expire'] = $_SESSION['start'] + (1 * 60) ;
			//
			// 	echo "<div class='alert alert-success mt-4' role='alert'><strong>Welcome!</strong> ".$row['name']."
			// 	</div>";
			//
			// } else {
			// 	echo "<div class='alert alert-danger mt-4' role='alert'>Email or Password are incorrects!
			// 	<p><a href='layouts/login.html'><strong>Please try again!</strong></a></p></div>";
			// }


			if ($password ==$hash) {

				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $row['name'];
				$_SESSION['idUser'] = $row['id'];

				echo "<div class='alert alert-success mt-4' role='alert'><strong>Welcome!</strong> ".$row['name']."
				</div>";

				header("location: layouts/homePage.php");

			} else {
				echo "<div class='alert alert-danger mt-4' role='alert'>Email or Password are incorrects!
				<p><a href='layouts/index.html'><strong>Please try again!</strong></a></p></div>";
			}
	?>
