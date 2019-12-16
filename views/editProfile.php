<?php

    session_start();

    if(isset($_SESSION['idUser'])){
        $nameUser = $_SESSION['name'];
		$idUser = $_SESSION['idUser'];
    }

    try{
        $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $updateName = $pdo->prepare("UPDATE user SET name='".$name."' where id=".$idUser."");
        $updateName->execute();
    }
    
    if(isset($_POST['newPassword']) && isset($_POST['confirmNewPassword'])){
        $password =hash('sha256',$_POST['newPassword']);
        $updatePassword = $pdo->prepare("UPDATE user SET password='".$password."' where id=".$idUser."");
        $updatePassword->execute();
    }

    header("location: layouts/editUser.php")

?>