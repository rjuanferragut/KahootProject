<?php

    session_start();

    include '../controllers/conn.php';

    if(isset($_POST['Delete'])){
        $idQuiz = $_POST['idQuiz'];
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
        } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }
        $query = $pdo->prepare("DELETE FROM quiz where id=".$idQuiz."");
        $query->execute();
        header("location: layouts/homePage.php");
    }

    if(isset($_POST['Edit'])){
        $idQuiz = $_POST['idQuiz'];
        $_SESSION['idQuiz'] = $idQuiz;
        header("location: layouts/editQuiz.php");
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