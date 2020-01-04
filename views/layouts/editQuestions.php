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
    <title>New Questions</title>
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/newQuestion.css">
    <script src="../../public/js/newQuestionBootstrap.js"></script>
    <!-- <script src="../../public/js/newQuestion.js"></script> -->
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
                    <form action="../../Login/login.php" method="Post">
                        <input type="submit" name="signOut" value="Sign out" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-4">
            <?php
                session_start();

                function str_limit($value, $limit = 100, $end = '...'){
                    if (mb_strwidth($value, 'UTF-8') <= $limit) {
                            return $value;
                    }
                    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
                }
                try{
                    $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
                } catch (PDOException $e) {
                    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                    exit;
                }
                if(isset($_SESSION['idQuiz'])){
                    $idQuiz = $_SESSION['idQuiz'];
                }
                $queryNameQuiz = $pdo->prepare("SELECT name FROM quiz WHERE id=".$idQuiz."");
                $queryNameQuiz->execute();
                $registreNameQuiz = $queryNameQuiz->fetch();

                echo "<div class=''>";
                echo "<h2 class='my-3' style='text-align:center'>".$registreNameQuiz['name']."</h2>";
                echo "</div>";

                $queryNameQuestions = $pdo->prepare("SELECT * FROM question WHERE fk_id_quiz=".$idQuiz."");
                $queryNameQuestions->execute();
                $registreNameQuestions = $queryNameQuestions->fetch();

                while($registreNameQuestions){
                    $idQuestion = $registreNameQuestions['id'];
                    $textQuestion = $registreNameQuestions['text_question'];
                    $textQuestion = str_limit($textQuestion, 25);
                    echo '<form action="editQuestions.php" method="POST">';
                    echo '<div class="input-group col-10 mx-auto mt-3">';
                    echo '<input type="hidden" name="idQuestion" value="'.$idQuestion.'">';
                    echo '<input type="text" class="form-control" value="'.$textQuestion.'" aria-label="Recipients username with two button addons" aria-describedby="button-addon4" disabled>';
                    echo '<div class="input-group-append" id="button-addon4">';
                        echo '<button type="submit" name="Edit" value="Edit" class="btn btn-warning" type="button">Edit</button>';
                        echo '<button type="submit" name="Delete" value="Delete"class="btn btn-danger" type="button">Delete</button>';
                    echo '</div>';
                    echo '</div>';
                    // echo '<div>';
                    // echo '<label class="col-8 h3 mb-0" style="text-align:center">'.$textQuestion.'</label>';
                    // echo '<input type="hidden" name="idQuestion" value="'.$idQuestion.'">';
                    // echo '</div>';
                    echo '</form>';
                    $registreNameQuestions = $queryNameQuestions->fetch();
                }
            ?>
        </div>
        <div class="col-8" id="Questions">

                <?php

                    echo '<input type="hidden" name="edit" value="false">';
                     
                    if(isset($_SESSION['idUser'])){
                        $idUser = $_SESSION['idUser'];
                    }
                    
                    try{
                        $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
                    } catch (PDOException $e) {
                        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                        exit;
                    }
                    $queryNumQuestions = $pdo->prepare("SELECT count(*) as preguntas FROM question WHERE fk_id_quiz=".$idQuiz."");
                    $queryNumQuestions->execute();
                    $registreNumQuestions = $queryNumQuestions->fetch();
                    $numQuestions = $registreNumQuestions['preguntas'];

                    $queryRole = $pdo->prepare("SELECT * FROM user WHERE id=".$idUser."");
                    $queryRole->execute();
                    $registreRole = $queryRole->fetch();
                    $role = $registreRole['role'];

                    echo '<input type="hidden" id="role" value="'.$role.'">';
                    echo '<input type="hidden" id="numQuestions" value="'.$numQuestions.'">';

                    if(isset($_POST['Delete'])){
                        $idQ = $_POST['idQuestion'];
                        $queryDeleteQuestion = $pdo->prepare("DELETE FROM question WHERE id=".$idQ."");
                        $queryDeleteQuestion->execute();
                        $registreDeleteQuestion = $queryDeleteQuestion->fetch();
                    }

                    if(isset($_POST['Edit'])){
                        $idQ = $_POST['idQuestion'];

                        echo '<input type="hidden" name="edit" value="true">';

                        $queryEditQuestion = $pdo->prepare("SELECT * FROM question WHERE id=".$idQ."");
                        $queryEditQuestion->execute();
                        $registreEditQuestion = $queryEditQuestion->fetch();

                        $queryEditAnswers = $pdo->prepare("SELECT * FROM answer WHERE fk_id_quiz=".$idQ."");
                        $queryEditAnswers->execute();
                        $registreEditAnswers = $queryEditAnswers->fetch();

                        $typeQuestion = $registreEditQuestion['type'];
                        $textQuestion = $registreEditQuestion['text_question'];
                        $timeQuestion = $registreEditQuestion['time'];
                        $pointsQuestion = $registreEditQuestion['points'];

                        echo '<input type="hidden" name="questionType" value="'.$typeQuestion.'">';
                        echo '<input type="hidden" name="textQuestion" value="'.$textQuestion.'">';
                        echo '<input type="hidden" name="timeQuestion" value="'.$timeQuestion.'">';
                        echo '<input type="hidden" name="pointsQuestion" value="'.$pointsQuestion.'">';


                        if($typeQuestion == "true/flase"){

                            while($registreEditAnswers){
                                $idA = $registreEditAnswers['id'];
                                $textAnswer = $registreEditAnswers['text_answer'];
                                $correctAnswer = $registreEditAnswers['correct'];

                                echo '<input type="hidden" class="answer" value="'.$idA.'">';
                                echo '<input type="hidden" class="'.$idA.'" value="'.$textAnswer.'">';
                                echo '<input type="hidden" class="'.$idA.'" value="'.$correctAnswer.'">';

                                $registreEditAnswers = $queryEditAnswers->fetch();
                            }


                        }elseif($typeQuestion == "multipleChoice"){

                        }elseif($typeQuestion == "ompleElsForats"){

                        }



                        // echo "<script>main();</script>";
                    }

                ?>
            
            <select id="typeQuestion" class="custom-select col-3 mt-3" name="typeQuestion" onchange="main()">
                <option selected>Select the type of question</option>
                <option value="true/false">True/False</option>
                <option value="multipleChoice">Multiple Choice</option>
                <option value="ompleElsForats">Omple els forats</option>
            </select>
        </div>
    </div>
    </body>
</html>