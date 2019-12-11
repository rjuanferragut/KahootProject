<?php

include '../controllers/random_id_pin.php';

session_start();
// isset($_SESSION['loggedin']) && 

    if(isset($_SESSION['name'])){
        echo $_SESSION['name'];
    }
    if(isset($_SESSION['name']) && isset($_SESSION['idUser']) && isset($_SESSION['idQuiz'])){
        $loggedin = $_SESSION['loggedin'];
		$nameUser = $_SESSION['name'];
        $idUser = $_SESSION['idUser'];
        $idQuiz = $_SESSION['idQuiz'];
        echo $idQuiz;
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
            
            $insertPregunta = "insert into question (id, text_question, type, points, fk_id_quiz) value(".$id.",'".$textQuestion."','true/false',".$points.",".$idQuiz.")";
            $resultPrgunta = mysqli_query($conn, $insertPregunta);

            $idAnswer1= randomID();
            $idAnswer2= randomID();

            if($correct == 'true'){
                $insertAnsewr1 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer1.",'True', true, ".$id.")";
                $insertAnsewr2 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer2.",'False', false, ".$id.")";
            }elseif($correct == 'false'){
                $insertAnsewr1 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer1.",'True', false, ".$id.")";
                $insertAnsewr2 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer2.",'False', true, ".$id.")";
            } 

            $resultAnswer1 = mysqli_query($conn, $insertAnsewr1);
            $resultAnswer2 = mysqli_query($conn, $insertAnsewr2);

            header("location: layouts/newQuestion.php");

        }

    } else if (isset($_POST['Done'])){
        header("location: layouts/homePage.php");
    } else {
        header("location: layouts/newQuestion.php");
    }

?>