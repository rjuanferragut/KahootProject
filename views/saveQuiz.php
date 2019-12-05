<?php

include '../controllers/conn.php';
include '../controllers/random_id_pin.php';

    session_start();

    if(isset($_SESSION['loggedin']) && isset($_SESSION['name']) && isset($_SESSION['idUser'])){

        $loggedin = $_SESSION['loggedin'];
	    $nameUser = $_SESSION['name'];
        $idUser = $_SESSION['idUser'];

    }

    if (isset($_POST['name']) && isset($_POST['resume'])){

        // Connection variables
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
        }

        $name = $_POST['name'];
        $resume = $_POST['resume'];

        $id = randomID();
        $_SESSION['idQuiz'] = $id;

        $insert = "insert into quiz (id, name, resume, create_date, num_questions, num_plays, fk_id_user) value(".$id.",'".$name."', '".$resume."', curdate(), 0, 0, ".$idUser." )";
        $result = mysqli_query($conn, $insert);

        if(mysqli_num_rows($result)>0){
            echo "<script type='text/javascript'>alert('Quiz created succesfully');</script>";
        }else{
            header("location: layouts/newQuiz.html");
        }
        

        header("location: layouts/newQuestion.html");

    }
        

?>