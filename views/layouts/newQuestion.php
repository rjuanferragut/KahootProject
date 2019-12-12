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
            <a href="#" class="navbar-brand">KAHOOT</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <a href="#" class="nav-item nav-link">Sign out</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-4">
            <h2>Here you'll see the created Questions</h2>
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
                $queryNameQuiz = $pdo->prepare("SELECT name FROM quiz WHERE id=".$idQuiz."");
                $queryNameQuiz->execute();
                $registreNameQuiz = $queryNameQuiz->fetch();

                echo "<h2>".$registreNameQuiz['name']."</h2>";

                $queryNameQuestions = $pdo->prepare("SELECT * FROM question WHERE fk_id_quiz=".$idQuiz."");
                $queryNameQuestions->execute();
                $registreNameQuestions = $queryNameQuestions->fetch();

                while($registreNameQuestions){
                    $idQuestion = $registreNameQuestions['id'];
                    $textQuestion = $registreNameQuestions['text_question'];
                    echo '<form action="#" method="POST">';
                    echo '<label class="col3">'.$textQuestion.'</label>';
                    echo '<input type="hidden" name="idQuestion" value="'.$idQuestion.'">';
                    echo '<input type="submit" name="delete" value="X" class="btn btn-danger rounded-circle col-1">';
                    // <div class="input-group mb-3">
                    //     <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    //         <div class="input-group-append">
                    //         <button class="btn btn-outline-secondary" type="button">Button</button>
                    //     </div>
                    // </div>
                    // https://getbootstrap.com/docs/4.0/components/input-group/
                    echo '</form>';
                    $registreNameQuestions = $queryNameQuestions->fetch();
                }

            ?>
        </div>
        <div class="col-8" id="Questions">
            <select id="typeQuestion" class="custom-select col-3 mt-3" name="typeQuestion" onchange="main()">
                <option selected>Select the type of question</option>
                <option value="true/false">True/False</option>
                <option value="multipleChoice">Multiple Choice</option>
            </select>
        </div>
    </div>
    <!-- <div class= "content"> -->
        <!-- <form action="../saveQuestion.php" method="post"> -->
        <!-- <form action="" method="post">
            <a>Question:</a>
            <input id="question" type="text" name="text_question" placeholder="Enter your question">
            <select name="" id="typequestion"></select>
            <label id="true"><input id="ButtonTrue" type="radio" name="correct?" value="true">TRUE</label>
            <label id="false"><input id="ButtonFalse" type="radio" name="correct?" value="false">FALSE</label>
            <select name="time" class="seconds">
                <option value="10">10s</option>
                <option value="20">20s</option>
                <option value="30">30s</option>
                <option value="40">40s</option>
                <option value="50">50s</option>
                <option value="60">60s</option>
            </select>
            <select name="points" class="points">
                <option value="10">10 points</option>
                <option value="50">50 points</option>
                <option value="100">100 points</option>
                <option value="150">150 points</option>
                <option value="300">300 points</option>
                <option value="500">500 points</option>
                <option value="1000">1000 points</option>
            </select>
            <input id ="SaveQuestion" type="submit" name="AddQuestion" value="AddQuestion" />
            <input id ="EndQuestions" type="submit" name="Done" value="Done" />
        </form> -->
    <!-- </div> -->
</body>
</html>
