<!DOCTYPE html>
<html>
<head> 
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<title></title>
	<link rel="stylesheet" href="../../public/css/header.css">

</head>
<body>
 <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    	<a href="#" class="navbar-brand">KAHOOT</a>
    </nav>
 </div>
<?php

        session_start();
	      // Connection info. file
	      include '../../controllers/conn.php';
	      //include '../controllers/random_id_pin.php';

	      if(isset($_SESSION['roomPin']) && isset($_SESSION['idQuiz'])){
	        $roomPin = $_SESSION['roomPin'];
	        $idQuiz = $_SESSION['idQuiz'];
	      }

	      if(isset($_SESSION['listAnswers'])){
	      	$listAnswers = $_SESSION['listAnswers'];
	      }
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	      // Check connection
	      if (!$conn) {
	        die("Connection failed: " . mysqli_connect_error());
	      }


	      foreach ($listAnswers as $key) {

                if ($key=="True") {

                    echo "<button style='background-color:green; text-align:center ' class='btn btn-responsive col-5 centrado mt-4 mr-2 ml-2' >".$key."</button>";
                    
                }else{

                    echo "<button style='background-color:red; text-align:center' class='btn btn-responsive col-5 centrado mt-4' >".$key."</button>";
                }
                
          
            }  
            

?>
	

</body>
</html>