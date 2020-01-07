<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="refresh" content="3">
	<title>Waiting</title>
	 <link rel="stylesheet" href="../../public/css/header.css">
	 <link rel="stylesheet" href="../../public/css/playersWaiting.css">
</head>
<body>
	<div class="header">
		<a>Kahoot</a>
	</div>
	<div class="padre">
		<h1>You're in!</h1>
		<h3>See your nickname on screen?</h3>
	</div>
	<?php

		session_start();
	      // Connection info. file
	      include '../../controllers/conn.php';
	      //include '../controllers/random_id_pin.php';

	      if(isset($_SESSION['roomPin'])){
	        $roomPin = $_SESSION['roomPin'];
	      }


	      // Connection variables
	      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	      // Check connection
	      if (!$conn) {
	        die("Connection failed: " . mysqli_connect_error());
	      }


      	$consulta ="SELECT * FROM room WHERE pin=".$roomPin.";";
      	$result = mysqli_query($conn, $consulta);
      	$row = mysqli_fetch_assoc($result);
      	

      	if ($row['event']=="Question") {
      		header('location:PlayerQuestion.php');
      	}

	?>
</body>
</html>