<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/homePage.css">
</head>
<body>
    <div class="header">
        <a>Kahoot</a>

        <form action="../homePage.php" method="Post">
    
        <input type="submit" name="createQuiz" value="CreateQuiz">

    </form>
    </div>

    


    <?php

        session_start();

        // echo $_SESSION['test'];
        // echo $_SESSION['name'];
        // echo $_SESSION['idUser'];
      
        // include '../controllers/random_id_pin.php';

        function randomPin(){

            $digits = 5;
            $pin = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    
            return $pin;
        }
        function printQuiz(){
            try{
                $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
            } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
            }
            $query = $pdo->prepare("SELECT * FROM quiz");
            $query->execute();
            $registre = $query->fetch();
            while($registre){
                echo "<br><div class='quiz'>";
                echo '<form method="Post" action="../createRoom.php">';
                echo "<a>Name: ".$registre['name']."</a>";
                echo "<a>Create date: ".$registre['create_date']."</a>";
                echo '<input type="hidden" name="pin" value="'.randomPin().'">';
                echo '<input type="hidden" name="idQuiz" value="'.$registre['id'].'">';
                // if($registre['fk_id_user']== $_SESSION['idUser']){
                //     echo "<input type='submit' name='Edit' value='Edit'>";
                // }
                echo "<input type='submit' name='Play' value='Play'><br>";
                echo "<a>Description: ".$registre['resume']."</a>";
                echo "</form>";
                echo "</div>";
                $registre = $query->fetch();
            }
        }
        
        printQuiz();
    ?>
</body>
</html>