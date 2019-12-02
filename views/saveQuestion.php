<?php

session_start();

        $loggedin = $_SESSION['loggedin'];
		$nameUser = $_SESSION['name'];
		$idUser = $_SESSION['idUser'];

    if (isset($_POST['AddQuestion'])) {
        
        if(isset($_POST['text_question']) && isset($_POST['correct?']) && isset($_POST['time']) && isset($_POST['points'])){

            $textQuestion = $_POST['text_question'];
            $correct = $_POST['correct?'];
            $time = $_POST['time'];
            $points = $_POST['points'];

        }

    } else if (isset($_POST['Done'])){
        //redirect to done
    } else {
        //invalid action!
    }

?>