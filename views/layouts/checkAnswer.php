<?php
    session_start();

    if(isset($_POST['typeQuestion'])){
        $typeQuestion = $_POST['typeQuestion'];
    }

    try{
        $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $idPlayer = $_SESSION['idPlayer'];
    

    if( $typeQuestion == "true/false"){
        $idAnswer = $_POST['answer'];

        $query = $pdo->prepare("SELECT * FROM answer where id=".$idAnswer."");
        $query->execute();
        $registre = $query->fetch();

        $queryAnswerPlayer = $pdo->prepare("INSERT INTO player_answer value(".$idAnswer.",".$idPlayer.")");
        $queryAnswerPlayer->execute();

        if($registre['correct'] == 1){

        }elseif ($registre['correct'] == 0) {
            # code...
        }

    }elseif ($typeQuestion == "multipleChoice") {
        $idsAnswers = $_POST['answers'];
        $contadorCorrectAnswers = 0;
        $contadorIncorrectAnswers = 0;

        $query = $pdo->prepare("SELECT * FROM answer where id=".$idsAnswers[0]."");
        $query->execute();
        $registre = $query->fetch();
        $idQuestion = $registre['fk_id_question'];

        $query = $pdo->prepare("SELECT count(*) as correctas FROM answer where fk_id_question=".$idQuestion." and correct=1");
        $query->execute();
        $registre = $query->fetch();
        $correctAnswers = $registre['correctas'];


        foreach($idsAnswers as $key){
            $query = $pdo->prepare("SELECT * FROM answer where id=".$key."");
            $query->execute();
            $registre = $query->fetch();

            $queryAnswerPlayer = $pdo->prepare("INSERT INTO player_answer value(".$key.",".$idPlayer.")");
            $queryAnswerPlayer->execute();
            $registre = $queryAnswerPlayer->fetch();

            if($registre['correct'] == 1){
                $contadorCorrectAnswers +=1;

            }elseif ($registre['correct'] == 0) {
                $contadorIncorrectAnswers +=1;

            }
        }

        if($contadorCorrectAnswers == $correctAnswers && $contadorIncorrectAnswers == 0){

        }else{
            

        }


        # code...
    }elseif ($typeQuestion == "ompleElsForats") {
        # code...
    }

?>
