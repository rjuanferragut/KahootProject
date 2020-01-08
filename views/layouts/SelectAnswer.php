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
<div class="header">
	<a>Kahoot</a>
</div>

<?php
        session_start();
	      // Connection info. file
	      include '../../controllers/conn.php';
	      //include '../controllers/random_id_pin.php';
	      if(isset($_SESSION['roomPin']) && isset($_SESSION['idQuiz'])){
	        $roomPin = $_SESSION['roomPin'];
	        $idQuiz = $_SESSION['idQuiz'];
	        
	        
	        $textQuestion = $_SESSION['TextQuestion'];
	      }
	      if(isset($_SESSION['listAnswers'])){
	      	$listAnswers = $_SESSION['listAnswers'];
	      }
        $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	      // Check connection
	      if (!$conn) {
	        die("Connection failed: " . mysqli_connect_error());
	      }
	     	echo "<div style= ' background-color: lightblue;'>";
         	echo "<label class='h1 col-12 mb-0 py-5' style='text-align: center'>".$textQuestion."</label>";
            
            echo "</div>";

	      foreach ($listAnswers as $key) {
	      	
	      	echo "<div class='form-row'>";
	      	
	      	if($_SESSION['typeQuestion'] == "true/false"){
	      	
               
	      		if ($key=="True") {
                    echo "<button style='background-color:green; display: flex; justify-content: center; height:100px; text-align:center;' class='btn btn-responsive mt-4 btn-lg btn-block ml-4 mr-4' >".$key."</button>";
                    
                }else if($key=="False"){
                    echo "<button style='background-color:red; height:100px; text-align:center' class='btn btn-responsive btn-block mt-4 ml-4 mr-4' >".$key."</button>";
                }
               
               
	      		}else if($_SESSION['typeQuestion'] == "multipleChoice"){
	      			echo "<button style='background-color:GREY; display: flex; justify-content: center; height:100px; text-align:center;' class='btn btn-responsive mt-4 btn-lg btn-block ml-4 mr-4' >".$key."</button>";
              
          	
            	}else if($_SESSION['typeQuestion'] == "ompleElsForats"){
            	
            	}
            echo "</div>";	
	    }
            
?>
	
<div>
</body>
</html>