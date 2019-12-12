<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Home</title>
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/homePage.css">
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="../../Login/index.html" class="navbar-brand">KAHOOT</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <form action="../homePage.php" method="Post">
                        <input type="submit" name="createQuiz" value="NEW QUIZ" class="btn btn-success">
                    </form>
                    <form action="#" method="Post">
                        <input type="submit" name="signOut" value="Sign out" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </nav>
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
            echo '<div class="card-columns">';
            while($registre){
                // echo "<br><div class='quiz'>";
                // echo '<form method="Post" action="../createRoom.php">';
                // echo "<a>Name: ".$registre['name']."</a>";
                // echo "<a>Create date: ".$registre['create_date']."</a>";
                // echo '<input type="hidden" name="pin" value="'.randomPin().'">';
                // echo '<input type="hidden" name="idQuiz" value="'.$registre['id'].'">';
                // // if($registre['fk_id_user']== $_SESSION['idUser']){
                // //     echo "<input type='submit' name='Edit' value='Edit'>";
                // // }
                // echo "<input type='submit' name='Play' value='Play'><br>";
                // echo "<a>Description: ".$registre['resume']."</a>";
                // echo "</form>";
                // echo "</div>";
                echo '<div class="card" style="width: 30rem;">';
                // echo '<img class="card-img-top" src="..." alt="Card image cap">';
                echo '<div class="card-body">';
                echo "<h5 class='card-title'>".$registre['name']."</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>".$registre['create_date']."</h6>";
                echo "<p class='card-text'>".$registre['resume']."</p>";
                echo '<form method="Post" action="../createRoom.php">';
                echo '<input type="hidden" name="pin" value="'.randomPin().'">';
                echo "<input type='hidden' name='idQuiz' value='".$registre['id']."'>";
                echo '<input type="submit" name="Play" value="Play" class="btn btn-primary">';
                echo "</form>";
                echo '</div>';
                echo '</div>';
                $registre = $query->fetch();
            }
            echo '</div>';
        }
        
        printQuiz();
    ?>
</body>
</html>