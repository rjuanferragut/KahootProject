<?php

    if(isset($_GET['token'])){
        $normalToken=$_GET['token'];
        echo $normalToken."Normal token <br>";
        $token=hash("sha256", $normalToken);
        echo $token."token<br>";

        try{
            $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
        } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }

        $query = $pdo->prepare("SELECT * FROM user_token where token='".$token."'");
        $query->execute();
        $registre = $query->fetch();

        print_r($registre);

        echo $registre['token']."token DataBase<br>";
        echo $registre['expires'];

        if($registre['token'] == $token && $registre['state'] == "unused"){

            echo "dentro if<br>";

            $idUser= $registre['fk_id_user'];

            $updateToken = $pdo->prepare("UPDATE user_token SET state='used' where token='".$token."'");
            $updateToken->execute();

            $updateState = $pdo->prepare("UPDATE user SET state='active' where id=".$idUser."");
            $updateState->execute();

            header("location: ../Login/login.php");

        }

    }else{

        header("location: ../Login/login.php");
    }

?>