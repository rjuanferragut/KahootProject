<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="refresh" content="3">
  	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title>Waiting</title>
	 <link rel="stylesheet" href="../../public/css/header.css">
	 <link rel="stylesheet" href="../../public/css/playersWaiting.css">
</head>
<body>
<div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    	<a href="#" class="navbar-brand">KAHOOT</a>
    </nav>
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