<?php

    session_start();

    include '../controllers/random_id_pin.php';
    include '../controllers/conn.php';

    if(isset($_POST['role']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])){

        $role = $_POST['role'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password1 = hash('sha256',$_POST['password1']);
        $password2 = hash('sha256',$_POST['password2']);

        if(isset($_POST['image'])){
            $image = $_POST['image'];
        }else{
            $image = "";
        }

        if($password1 != $password2){
            header("location: layouts/signUp.php?wrongPassword=true");
        }elseif($password1 == $password2){

            // Connection variables
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
            }

            $insertUser = "insert into user (email, name, password, role) value('".$email."', '".$name."', '".$password1."', '".$role."')";  
        }

    }

?>