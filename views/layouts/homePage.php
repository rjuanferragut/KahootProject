<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
                echo "ID: ".$registre['id']."<br>";
                echo "Name: ".$registre['name']."<br>";
                echo "Description: ".$registre['resume']."<br>";
                echo "Create date: ".$registre['create_date']."<br>";
                echo "</div>";
            }
        }
        printQuiz();

        ?>
</body>
</html>