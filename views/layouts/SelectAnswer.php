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

         	echo "<label class='h1 col-11 mb-0 py-5' style='text-align: center'>".$textQuestion."</label>";
            
            echo "</div>";

	      foreach ($listAnswers as $key) {

	      	if($_SESSION['typeQuestion'] == "true/false"){

	      		if ($key=="True") {

                    echo "<button style='background-color:green; height:; text-align:center;' class='btn btn-responsive col-5 centrado mt-4 mr-2 ml-2 row-5' >".$key."</button>";
                    
                }else if($key=="False"){

                    echo "<button style='background-color:red; height:; text-align:center' class='btn btn-responsive col-5 centrado mt-4 row-5' >".$key."</button>";
                }

	      	}else if($_SESSION['typeQuestion'] == "multipleChoice"){

	      		echo "<button style='background-color:blue; height:; text-align:center' class='btn btn-responsive col-5 centrado mt-4 row-5' >".$key."</button>";
              
          
            }else if($_SESSION['typeQuestion'] == "ompleElsForats"){

            	

            }



	    }
            

?>
	

</body>
</html>