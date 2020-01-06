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

    $checkPassword = $pdo->prepare("SELECT * FROM user WHERE id=".$idUser."");
    $checkPassword->execute();
    $registre = $checkPassword->fetch();

    $password = $registre['password'];
    $currentPassword = hash('sha256',$_POST['currentPassword']);

    echo $password."<br>";
    echo $currentPassword."<br>";

    if($password==$currentPassword){

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
    
        header("location: layouts/editUser.php");

    }else{
        $_SESSION['wrongPassword'] = "true";
        echo "wrong Password<br>";
        echo $_SESSION['wrongPassword'];
        
        header("location: layouts/editUser.php");
    }

    


    

?>