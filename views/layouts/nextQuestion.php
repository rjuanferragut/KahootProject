<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Question</title>
    <script src="../../public/js/nextQuestion.js"></script>
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
                <!-- <form action="../homePage.php" method="Post">
                    <input type="submit" name="createQuiz" value="NEW QUIZ" class="btn btn-success">
                </form>
                <form action="#" method="Post">
                    <input type="submit" name="signOut" value="Sign out" class="btn btn-danger">
                </form> -->
                </div>
            </div>
        </nav>
    </div>
    <?php

        session_start();

        try{
            $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
        } catch (PDOException $e) {
            echo "Failed to get DB handle: " . $e->getMessage() . "\n";
            exit;
        }

        

        if(isset($_SESSION['roomPin']) && isset($_SESSION['idQuiz'])){
            $pinRoom = $_SESSION['roomPin'];
            $idQuiz = $_SESSION['idQuiz'];

            if(isset($_SESSION['numQuestion'])){
                $numQuestion = $_SESSION['numQuestion'];
            }else{
                $_SESSION['numQuestion'] = 1;
            }

        }

        $queryNumQuestions = $pdo->prepare("SELECT count(*) as numQuestions FROM question WHERE fk_id_quiz=".$idQuiz."");
        $queryNumQuestions->execute();
        $registreNumQuestions = $queryNumQuestions->fetch();

       
        if($_SESSION['numQuestion']>$registreNumQuestions['numQuestions']){
            $_SESSION['numQuestion'] = 1;
        }

        
        $query = $pdo->prepare("SELECT * FROM question WHERE fk_id_quiz=".$idQuiz."");
        $query->execute();
        $registre = $query->fetch();
        $contador = 1;
        $listAnswers = [];
        while($registre){
            if($contador == $_SESSION['numQuestion']){
                $idQuestion = $registre['id'];
                echo "<div style= ' background-color: lightblue;'>";
                echo "<label class='h1 col-11 mb-0 py-5' style='text-align: center'>".$registre['text_question']."</label>";
                echo "<span id='countdown' style=' border: solid black' class='col-1 p-3 rounded-circle'></span>";
                echo "</div>";
                $_SESSION['TextQuestion'] = $registre['text_question'];
                //$_SESSION['numQuestion'] = $_SESSION['numQuestion'] + 1;
                $queryAnswer = $pdo->prepare("SELECT * FROM answer WHERE fk_id_question=".$idQuestion."");
                $queryAnswer->execute();
                $registreAnswer = $queryAnswer->fetch();
                while($registreAnswer){
                    array_push($listAnswers, $registreAnswer['text_answer']);
                    $_SESSION['listAnswers'] = $listAnswers;
                   echo "<span class= 'showQuestion' style='display: none'>".$registreAnswer['text_answer']."</span>";
                   $registreAnswer = $queryAnswer->fetch();
                }
                echo "<script>onload=updateClock()</script>";

                

            break;
            }else{
                $contador = $contador +1;
            }
            // echo $registre['text_question']."<br>";
            
            $registre = $query->fetch();
        }


    ?>
</body>
</html>