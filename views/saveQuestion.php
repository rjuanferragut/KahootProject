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
echo "fuera";
// check if the button press is to add another question

if (isset($_POST['AddQuestion'])) {
  echo "in addQuestion";

  if(isset($_POST['text_question']) && isset($_POST['time']) && isset($_POST['points']) && isset($_POST['idAnswer']) && isset($_POST['correctAnswer']) && isset($_POST['answer'])){
    echo "in MultipleChoice";
    $textAnswers = $_POST['answer'];
    $textQuestion= $_POST['text_question'];
    $idAnswers = $_POST['idAnswer'];
    $idCorrectAnswer = $_POST['correctAnswer'];
    $time = $_POST['time'];
    $points = $_POST['points'];
    $idQuestion = randomID();

    $image = $_FILES["customFile"];
    saveQuestionImage($image, $rute);
    // $_SESSION['idQuestion'] = $idQuestion;
    // Connection variables
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $insertPregunta = "insert into question (id, text_question, type, points, fk_id_quiz) value(".$idQuestion.",'".$textQuestion."','multiChoice',".$points.",".$idQuiz.")";
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


  }

  $image = $_FILES["customFile"];
  saveQuestionImage($image, $rute);
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


  $insertPregunta = "insert into question (id, text_question, type, points, fk_id_quiz) value(".$id.",'".$textQuestion."','true/false',".$points.",".$idQuiz.")";
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

print_r($_SESSION);
print_r($_FILES);
?>
