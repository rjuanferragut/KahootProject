<!DOCTYPE html> 
<html>
<head>
	<title></title>
</head>
<body>
<?php

session_start();

//include '../controllers/conn.php';
//$_SESSION['ContadorPregunta']= 1;

if(isset($_SESSION['idQuiz'])){
      $idQuiz = $_SESSION['idQuiz'];
    }



function PrintAnswer(){
			try{
                $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
            } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
            }


            $query = $pdo->prepare("SELECT * FROM question where fk_id_quiz=='".$idQuiz."'");
            $query->execute();
            $registre = $query->fetch();
            //$contador = 0;
            while($registre){

                echo "<br><div class='questions'>";
                echo '<form method="Post" action="">';
                echo "<a>Question: ".$registre['question_text']."</a>";
                //echo "<a>Create date: ".$registre['create_date']."</a>";
                //echo '<input type="hidden" name="pin" value="'.randomPin().'">';
                //echo '<input type="hidden" name="idQuiz" value="'.$registre['id'].'">';
                // if($registre['fk_id_user']== $_SESSION['idUser']){
                //     echo "<input type='submit' name='Edit' value='Edit'>";
                // }
                //echo "<input type='submit' name='Play' value='Play'><br>";
                //echo "<a>Description: ".$registre['resume']."</a>";
                echo "</form>";
                echo "</div>";
                $registre = $query->fetch();
            }
		}

		PrintAnswer();


?>
</body>
</html>









    