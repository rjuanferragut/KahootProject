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
    <title>New Quiz</title>
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/newQuiz.css">
</head>
<body>
	<div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="homePage.php" class="navbar-brand">KAHOOT</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <form action="../../Login/login.php" method="Post">
                        <!-- <input type="submit" name="createQuiz" value="Login" class="btn btn-success"> -->
                    </form>
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

                if(isset($_SESSION['idQuiz'])){
                    $idQuiz = $_SESSION['idQuiz'];
                }

                $queryQuiz = $pdo->prepare("SELECT * FROM quiz WHERE id=".$idQuiz."");
                $queryQuiz->execute();
                $registreQuiz = $queryQuiz->fetch();

                $name = $registreQuiz['name'];
                $description  = $registreQuiz['resume'];

            ?>
    
    <div class="content col-6 mx-auto mt-5">
        <label class="h2"> New Questonary</label>
        <form action="../saveQuiz.php" method="Post">
            <div class="input-group mb-3 mt-3">
                    <?php echo '<input type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="name" required="" value="'.$name.'">';?>
            </div>
     
             <div class="input-group mb-3 mt-3 ">
               <?php echo '<textarea style="height: 20vh;" class="form-control" aria-label="With textarea" name="resume" required="" value="">'.$description.'</textarea>'; ?> 
             </div>
             <?php echo '<input type="hidden" name="idQuiz" value="'.$idQuiz.'">';?>
             <input type="submit" value="Continue" class="btn btn-success">
        </form>
    </div>
    
    
</body>
</html>