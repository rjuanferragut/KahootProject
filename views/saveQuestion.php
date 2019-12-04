<?php

include '../controllers/random_id_pin.php';

session_start();

    if(isset($_SESSION['loggedin']) && isset($_SESSION['name']) && isset($_SESSION['idUser']) && isset($_SESSION['idQuiz'])){
        $loggedin = $_SESSION['loggedin'];
		$nameUser = $_SESSION['name'];
        $idUser = $_SESSION['idUser'];
        $idQuiz = $_SESSION['idQuiz'];
    }        
        
        //info of the database
        include '../controllers/conn.php';	

    // check if the button press is to add another question
    if (isset($_POST['AddQuestion'])) {
        
        //verifying that all the data is send correctly
        if(isset($_POST['text_question']) && isset($_POST['correct?']) && isset($_POST['time']) && isset($_POST['points'])){

            $textQuestion = $_POST['text_question'];
            $correct = $_POST['correct?'];
            $time = $_POST['time'];
            $points = $_POST['points'];

            $id = randomID();
            $_SESSION['idQuestion'] = $id;

            // Connection variables
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
            }
            
            $insert = "insert into question (id, text_question, type, points, fk_id_quiz) value(".$id.",'".$textQuestion."','true/false',".$points.",".$idQuiz.")";

        }

    } else if (isset($_POST['Done'])){
        header("location: layouts/newQuestion.html");
    } else {
        header("location: layouts/newQuestion.html");
    }

?>