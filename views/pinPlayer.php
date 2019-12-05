<?php

    include '../controllers/conn.php';
    session_start();
    // Connection variables
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    if(isset($_POST['PIN'])){
        $pin=$_POST['PIN'];
        $consulta ="SELECT pin FROM room WHERE pin=".$pin." ;";
        $result = mysqli_query($conn, $consulta);
        if(mysqli_num_rows($result)>0){
            $_SESSION['roomPin'] = $pin;
            header("location: layouts/PINPlayer.html");
        }
    }
?>