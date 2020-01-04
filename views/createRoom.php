<?php

    session_start();

    include '../controllers/conn.php';

    if(isset($_POST['Edit'])){
        header("location: layouts/editQuestions.php");
    }

    if(isset($_POST['Play'])){

        if(isset($_POST['pin']) && isset($_POST['idQuiz'])){

            $_SESSION['roomPin']= $_POST['pin'];
            $pin = $_POST['pin'];
            $idQuiz = $_POST['idQuiz'];
            $_SESSION['idQuiz'] = $idQuiz; 
    
            // Connection variables
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
            // Check connection
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
    
            $insert = "insert into room value(".$pin.", '', ". $idQuiz.")";
            $result = mysqli_query($conn, $insert);
    
            header("location: waitingForPlayers.php");
    
        }

    }

    

?>