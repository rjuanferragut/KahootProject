<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>

    <form action="../homePage.php" method="Post">
    
        <input type="submit" name="createQuiz" value="CreateQuiz">

    </form>

    <?php

        session_start();

        echo $_SESSION['test'];
        echo $_SESSION['name'];
        echo $_SESSION['idUser'];
      
        //include '../controllers/controller.php';

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
            if (!empty($registre)) {
                echo "<br><div class='quiz'>";
                echo '<form method="Post" action="">';
                echo "ID: ".$registre['id']."<br>";
                echo "Name: ".$registre['name']."<br>";
                echo "Description: ".$registre['resume']."<br>";
                echo "Create date: ".$registre['create_date']."<br>";
                echo '<input type="hidden" name="pin" value="'.randomPin().'"';
                echo '<input type="hidden" name="idQuiz" value="'.$registre['id'].'"';
                echo "<input type='submit' name='Play' value='Play'";
                if($registre['fk_id_user']== $_SESSION['idUser']){
                    echo "<input type='submit' name='Edit' value='Edit'";
                }
                echo "</form>";
                echo "</div>";
            }
        }
        
        printQuiz();
    ?>
</body>
</html>