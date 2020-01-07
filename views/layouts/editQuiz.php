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
    
    <div class="content">
	    <label> New Questonary</label>
        <form action="../saveQuiz.php" method="Post">
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

                echo '<input type="text" name="name" placeholder="Quetionary name" value="'.$name.'">';
                echo '<input type="text" name="resume" placeholder="Description" value="'.$description.'">';
                echo '<input type="hidden" name="idQuiz" value="'.$idQuiz.'">';
                echo '<input type="submit" name="Save" value="Save">';

            ?>
	        
	        
	    </form>
	</div>
    
    
</body>
</html>