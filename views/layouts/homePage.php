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
    <?php ob_start();  session_start();?>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="homePage.php" class="navbar-brand">KAHOOT</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <form action="../homePage.php" method="Post">
                    <?php
                        if(isset($_SESSION['idUser'])){
                            $idUser = $_SESSION['idUser'];
                        }
                        try{
                            $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
                        } catch (PDOException $e) {
                            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                            exit;
                        }
                        $query = $pdo->prepare("SELECT count(*) as questionarios FROM quiz where fk_id_user=".$idUser."");
                        $query->execute();
                        $registre = $query->fetch();
                        $query = $pdo->prepare("SELECT * FROM user where id=".$idUser."");
                        $query->execute();
                        $usuario = $query->fetch();
                        if($registre['questionarios'] >= 3 && $usuario['role']!="premium"){
                            echo '<input type="submit" name="createQuiz" value="NEW QUIZ" class="btn btn-success mr-2" disabled="disabled">';
                        }else{
                            echo '<input type="submit" name="createQuiz" value="NEW QUIZ" class="btn btn-success mr-2">';
                        }
                    ?>
                        <!-- <input type="submit" name="createQuiz" value="NEW QUIZ" class="btn btn-success mr-2"> -->

                    </form>
                    <form action="editUser.php" method="Post">
                        <input type="submit" name="editProfile" value="Profile" class="btn btn-warning mr-2">

                    </form>
                    <form action="../../Login/login.php" method="Post">
                        <input type="submit" name="signOut" value="Sign out" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <?php
        if(isset($_SESSION['idUser'])){
            $idUser = $_SESSION['idUser'];
        }
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
            $query = $pdo->prepare("SELECT * FROM quiz where fk_id_user=".$_SESSION['idUser']." ORDER BY name");
            $query->execute();
            $registre = $query->fetch();
            echo '<div class="card-columns">';
            while($registre){
                echo '<div class="card" style="width: 30rem;">';
                // echo '<img class="card-img-top" src="..." alt="Card image cap">';
                echo '<div class="card-body">';
                echo "<h5 class='card-title'>".$registre['name']."</h5>";
                echo "<h6 class='card-subtitle mb-2 text-muted'>".$registre['create_date']."</h6>";
                echo "<p class='card-text'>".$registre['resume']."</p>";
                echo '<form method="Post" action="../createRoom.php">';
                echo '<input type="hidden" name="pin" value="'.randomPin().'">';
                echo "<input type='hidden' name='idQuiz' value='".$registre['id']."'>";
                echo '<input type="submit" name="Play" value="Play" class="btn btn-primary mr-2">';
                echo '<input type="submit" name="Edit" value="Edit" class="btn btn-warning mr-2">';
                echo '<input type="submit" name="Delete" value="Delete" class="btn btn-danger">';
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
