<?php
include '../controllers/random_id_pin.php';
session_start();
$rute = "../public/img/imatges_kahoot/";
// isset($_SESSION['loggedin']) &&
if(isset($_SESSION['name'])){
  echo $_SESSION['name'];
}
if(isset($_SESSION['name']) && isset($_SESSION['idUser']) && isset($_SESSION['idQuiz'])){
  $loggedin = $_SESSION['loggedin'];
  $nameUser = $_SESSION['name'];
  $idUser = $_SESSION['idUser'];
  $idQuiz = $_SESSION['idQuiz'];
  echo $idQuiz;
}

//info of the database
include '../controllers/conn.php';
//echo "fuera";
// check if the button press is to add another question

// check if the button press is to add another question
if (isset($_POST['AddQuestion']) || isset($_POST['SaveQuestion'])) {

  if(isset($_POST['SaveQuestion'])){
    $idQuestion = $_POST['questionId'];

    try{
      $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
    } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
    }

    $deleteQuery = $pdo->prepare("DELETE FROM question WHERE id=".$idQuestion."");
    $deleteQuery->execute();

    echo "id Question: ".$idQuestion;
  }

  if(isset($_POST['textArea'])){

    $points = $_POST['points'];
    $string = $_POST['textArea'];
    $question = $_POST['textArea'];
    $start = "_<";
    $end = ">_";

    function tag_contents($string, $tag_open, $tag_close){
      foreach (explode($tag_open, $string) as $key => $value) {
        if(strpos($value, $tag_close) !== FALSE){
          $result[] = substr($value, 0, strpos($value, $tag_close));
        }
      }
      return $result;
    }

    $hiddenWords = tag_contents($string, $start, $end);
    $idQuestion = randomID();

    try{
      $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
    } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
    }

    if(isset($_POST['time'])){
      $time = $_POST['time'];
      $queryQuestion = $pdo->prepare("INSERT INTO question (id, text_question, type, time, points, fk_id_quiz) VALUE(".$idQuestion.", '".$question."', 'OmpleElsForats',".$time.", ".$points.", '".$idQuiz."')");
    }elseif(isset($_POST['waitingtime'])){
      $watingTime = $_POST['waitingtime'];
      $queryQuestion = $pdo->prepare("INSERT INTO question (id, text_question, type, waitingTime, points, fk_id_quiz) VALUE(".$idQuestion.", '".$question."', 'OmpleElsForats', ".$watingTime.", ".$points.", '".$idQuiz."')");
    }else{
      $queryQuestion = $pdo->prepare("INSERT INTO question (id, text_question, type, points, fk_id_quiz) VALUE(".$idQuestion.", '".$question."', 'OmpleElsForats', ".$points.", '".$idQuiz."')");
    }


    $queryQuestion->execute();

    $idAnswer = randomID();

    foreach($hiddenWords as $word){
      echo $word."<br>";
      $queryAnswer = $pdo->prepare("insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer.",'".$word."', true, ".$idQuestion.")");
      $queryAnswer->execute();
      $idAnswer = $idAnswer + 1;
    }

    // print_r($hiddenWords);
    header("location: layouts/newQuestion.php");

  }


  if(isset($_POST['text_question']) && isset($_POST['points']) && isset($_POST['idAnswer']) && isset($_POST['correctAnswer']) && isset($_POST['answer'])){
    //"in MultipleChoice";
    $textAnswers = $_POST['answer'];
    $textQuestion= $_POST['text_question'];
    $idAnswers = $_POST['idAnswer'];
    $idCorrectAnswer = $_POST['correctAnswer'];
    $time = $_POST['time'];
    $points = $_POST['points'];
    $idQuestion = randomID();

    $image = $_FILES["customFile"];
    saveQuestionImage($image, $rute);

    $insertPregunta = "insert into question (id, text_question, type, points, fk_id_quiz,imgDir) value(".$idQuestion.",'".$textQuestion."','multichoice',".$points.",".$idQuiz.",'".$_FILES['customFile']['name']."')";
    $resultPrgunta = mysqli_query($conn, $insertPregunta);

    //Connection variables
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['time'])){
      $time = $_POST['time'];
      $insertPregunta = "insert into question (id, text_question, type, time, points, fk_id_quiz,imgDir) value(".$idQuestion.",'".$textQuestion."','multipleChoice',".$time.",".$points.",".$idQuiz.",'".$_FILES['customFile']['name']."')";
    }elseif(isset($_POST['waitingtime'])){
      $watingTime = $_POST['waitingtime'];
      $insertPregunta = "insert into question (id, text_question, type, waitingTime, points, fk_id_quiz,imgDir) value(".$idQuestion.",'".$textQuestion."','multipleChoice',".$watingTime.",".$points.",".$idQuiz.",'".$_FILES['customFile']['name']."')";
    }else{
      $insertPregunta = "insert into question (id, text_question, type, points, fk_id_quiz,imgDir) value(".$idQuestion.",'".$textQuestion."','multipleChoice',".$points.",".$idQuiz.",'".$_FILES['customFile']['name']."')";
    }

    //$insertPregunta = "insert into question (id, text_question, type, points, fk_id_quiz,imgDir) value(".$idQuestion.",'".$textQuestion."','multichoice',".$points.",".$idQuiz.",'".$_FILES['customFile']['name']."')";
    $resultPrgunta = mysqli_query($conn, $insertPregunta);

    for($i = 0; $i < sizeof($textAnswers); $i++){
      $textQ = $textAnswers[$i];
      $idAns = $idAnswers[$i];
      if(in_array($idAnswers[$i], $idCorrectAnswer)){
        $insertAnswer = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAns.",'".$textQ."', true, ".$idQuestion.")";
        $result = mysqli_query($conn, $insertAnswer);
      }else{
        $insertAnswer = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAns.",'".$textQ."', false, ".$idQuestion.")";
        $result = mysqli_query($conn, $insertAnswer);
      }

    }

    echo "id respuestas: ";
    print_r($idAnswers);
    echo "<br> id respuestas correctas: ";
    print_r($idCorrectAnswer);
    $image = $_FILES["customFile"];
    saveQuestionImage($image, $rute);
    header("location: layouts/newQuestion.php");

  }


}

//verifying that all the data is send correctly
if(isset($_POST['text_question']) && isset($_POST['correct?']) && isset($_POST['time']) && isset($_POST['points'])){
  echo "in True/False";
  $textQuestion = $_POST['text_question'];
  $correct = $_POST['correct?'];
  $time = $_POST['time'];
  $points = $_POST['points'];
  $id = randomID();

  $image = $_FILES["customFile"];
  saveQuestionImage($image, $rute);

  $_SESSION['idQuestion'] = $id;

  // Connection variables
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }


  $insertPregunta = "insert into question (id, text_question, type, points, fk_id_quiz, imgDir) value(".$id.",'".$textQuestion."','true/false',".$points.",".$idQuiz.",'".$_FILES['customFile']['name']."')";
  $resultPrgunta = mysqli_query($conn, $insertPregunta);
  $idAnswer1= randomID();
  $idAnswer2= randomID();
  if($correct == 'true'){
    $insertAnsewr1 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer1.",'True', true, ".$id.")";
    $insertAnsewr2 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer2.",'False', false, ".$id.")";
  }elseif($correct == 'false'){
    $insertAnsewr1 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer1.",'True', false, ".$id.")";
    $insertAnsewr2 = "insert into answer (id, text_answer, correct, fk_id_question) value(".$idAnswer2.",'False', true, ".$id.")";
  }
  $resultAnswer1 = mysqli_query($conn, $insertAnsewr1);
  $resultAnswer2 = mysqli_query($conn, $insertAnsewr2);

  header("location: layouts/newQuestion.php");

} else if (isset($_POST['Done'])){
  $image = $_FILES["customFile"];
  saveQuestionImage($image, $rute);
  header("location: layouts/homePage.php");
} else {
  header("location: layouts/newQuestion.php");
}

?>
