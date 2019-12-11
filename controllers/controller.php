<?php

include "random_id_pin.php";

//Function to show in the home page all the quiz created
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
    echo "</form>";
    echo "</div>";
  }
}
?>
