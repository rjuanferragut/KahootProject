<?php

session_start();

include '../controllers/conn.php';
include '../controllers/random_id_pin.php';

    if(isset($_SESSION['roomPin'])){
        $roomPin = $_SESSION['roomPin'];

        if(isset($_POST['nickName'])){
            $nickName= $_POST['nickName'];

            // Connection variables
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            // Check connection
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }

            $idPlayer = randomID();
            $insert ="insert into player (id, name, fk_pin_room) value(".$idPlayer.", '".$nickName."', ".$roomPin.")";

            header("location: layouts/waitingForPlayers");
        }

    }else{
        header("location: layouts/NamePlayer.html");
    }

?>