<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label>Sign Up as a:</label>
        <label id="teacher"><input id="ButtonTeacher" type="radio" name="role" value="teacher">TEACHER</label>
        <label id="student"><input id="ButtonStudent" type="radio" name="role" value="student">STUDENT</label>
        <input type="text" name="name" id="name" placeholder="Name">
        <input type="email" name="email" id="email" placeholder="Email">
        <?php 
            if(isset($_GET['wrongPassword'])){
                echo "<h5 style='color: red'>**passwords doesn't match**</h5>";
            }
        ?>
        <input type="password" name="password1" id="password1" placeholder="Introduce Your password">
        <input type="password" name="password2" id="password2" placeholder="Introduce Your password again">
        <input type="file" name="image" value="Search" accept="image/*">
        <input type="submit" value="SingUp">
    </form>
</body>
</html>