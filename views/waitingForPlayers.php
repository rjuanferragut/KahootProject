<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="3">
  <title>Waiting For Players</title>
  <link rel="stylesheet" href="../public/css/waitingForPlayers.css">
  <?php
  session_start();
  // Connection info. file
  include '../controllers/conn.php';
  //include '../controllers/random_id_pin.php';

  // Connection variables
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }


  // Query sent to database
  //falta la llamada al pin de la room entre los dos puntos
  //$consulta ="SELECT pin FROM room WHERE pin="..";";
  $consulta ="SELECT pin FROM room WHERE pin= 12345;";
  $result = mysqli_query($conn, $consulta);


  // Variable $row hold the result of the query
  $row = mysqli_fetch_assoc($result);
  $names = "SELECT name FROM player WHERE fk_pin_room = '".$row['pin']."';";
  $resultNames = mysqli_query($conn, $names);
  $countNames = mysqli_num_rows($resultNames);
  ?>
</head>
<body>
  <div class="pinZone">
    <?php
    echo "<h1> PIN: ".$row['pin']."</h1>";
    echo "<h3>Waiting For Players...</h3>";

      ?>

  </div>
  <form action="" method="post">
    <!-- <input id="start" type="submit" value="START"> -->
    <?php
    echo "<h2>".$countNames." Player</h2>";
    if($countNames != 0){
      echo "<input id='start' type='submit' value='START'>";
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
