<?php

    // session_start();

    // include '../controllers/random_id_pin.php';

    // if(isset($_POST['role']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])){

    //     $role = $_POST['role'];
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     $password1 = hash('sha256',$_POST['password1']);
    //     $password2 = hash('sha256',$_POST['password2']);

    //     if(isset($_POST['image'])){
    //         $image = $_POST['image'];
    //     }else{
    //         $image = "";
    //     }

    //     try{
    //         $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
    //     } catch (PDOException $e) {
    //         echo "Failed to get DB handle: " . $e->getMessage() . "\n";
    //         exit;
    //     }

    //     $checkEmail = $pdo->prepare("SELECT count(*) as num FROM user WHERE email='".$email."'");
    //     $checkEmail->execute();
    //     $registre = $query->fetch();

    //     if($registre['num']>0){
            
    //     }else{
    //         $inserUser = $pdo->prepare("insert into user (email, name, password, role, state) value('".$email."', '".$name."', '".$password1."', '".$role."', 'disable')");
    //         $inserUser->execute();

            
            

    //         header("location: ../Login/index.html");
    //     }

        
    


    // }

?>