<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="3">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <title>Waiting For Players</title>
  <link rel="stylesheet" href="../public/css/waitingForPlayers.css">
    <?php
      session_start();
      // Connection info. file
      include '../controllers/conn.php';
      //include '../controllers/random_id_pin.php';

      if(isset($_SESSION['roomPin'])){
        $roomPin = $_SESSION['roomPin'];
      }

      // Connection variables
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Query sent to database
      //falta la llamada al pin de la room entre los dos puntos
      $consulta ="SELECT pin FROM room WHERE pin=".$roomPin.";";
      // $consulta ="SELECT pin FROM room WHERE pin= 12345;";
      $result = mysqli_query($conn, $consulta);

      // Variable $row hold the result of the query
      $row = mysqli_fetch_assoc($result);
      $names = "SELECT name FROM player WHERE fk_pin_room = '".$row['pin']."';";
      $resultNames = mysqli_query($conn, $names);
      $countNames = mysqli_num_rows($resultNames);

    ?>

</head>
<body>
  <div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../Login/index.html" class="navbar-brand">KAHOOT</a>
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
  <div class="pinZone">
    <?php
    echo "<h1> PIN: ".$row['pin']."</h1>";
    echo "<h3>Waiting For Players...</h3>";
      ?>

  </div>
<<<<<<< HEAD
  <form action="layouts/ShowQuestion.php" method="post">
=======
  <form action="layouts/nextQuestion.php" method="post">
>>>>>>> cf04426767d5ac681df816be55bf2ea6d67a353c
    <!-- <input id="start" type="submit" value="START"> -->
    <?php

    echo "<h2>".$countNames." Player</h2>";

    if($countNames != 0){
<<<<<<< HEAD
      echo "<input id='start' type='submit' value='START' onclick='location.href='layouts/ShowQuestion.php';'>";
      
=======
      echo "<input id='start' type='submit' value='START'>";
      // echo '<input type="submit" value="Start" class="btn btn-primary">';
>>>>>>> cf04426767d5ac681df816be55bf2ea6d67a353c
    }
    echo "<div class='names'>";

   

    while( $rowNames = mysqli_fetch_assoc($resultNames) )
      {
        echo "<h3>".$rowNames["name"]."</h3>\n";
      }
    echo "</div>";
    ?>



  </form>
</body>
</html>