<?php

//include '../controllers/conn.php';
include '../controllers/random_id_pin.php';

    session_start();

    echo $_SESSION['test'];

    if(isset($_SESSION['name'])){
        echo $_SESSION['name'];
    }

    if(isset($_SESSION['loggedin']) && isset($_SESSION['name']) && isset($_SESSION['idUser'])){

        $loggedin = $_SESSION['loggedin'];
	    $nameUser = $_SESSION['name'];
        $idUser = $_SESSION['idUser'];

    }

    if(isset($_POST['createQuiz'])){

        header("location:layouts/newQuiz.html");

    }



?>