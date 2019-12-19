<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta http-equiv="refresh" content="3">
	<link rel="stylesheet" href="../../public/css/header.css">
	<link rel="stylesheet" href="../../public/css/playersWaiting.css">
</head>
<body>

 <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="PINPlayer.html" class="navbar-brand">KAHOOT</a>
    </nav>
 </div>
	<div class="padre">
		<h1>Question</h1>
		<h3>Read the question in the other screen!</h3>
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
      	

      	if ($row['event']=="Answer") {
      		header('location:SelectAnswer.php');
      	}

	?>
</body>
</html>