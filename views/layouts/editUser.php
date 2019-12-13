<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <scrpit src="../../public/js/editUser.js"></script>
    <title>Edit User</title>
</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION['idUser'])){
		$idUser = $_SESSION['idUser'];
    }

    try{
        $pdo = new PDO("mysql:host=localhost;dbname=kahoot", "admin", "admin123");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $query = $pdo->prepare("SELECT * FROM user where id=".$idUser."");
    $query->execute();
    $registre = $query->fetch();
    $email = $registre['email'];
    $name = $registre['name'];
    $imgUser = $registre['imgDirUser'];
    ?>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="#" class="navbar-brand">KAHOOT</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ml-auto">
                    <form action="#" method="Post">
                        <input type="submit" name="signOut" value="Sign out" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <div class="container py-2">
        <div class="row my-2">
            <!-- edit form column -->
            <div class="col-lg-4">
                <h2 class="text-center font-weight-light"><?php echo $name; ?> Profile</h2>
            </div>
            <div class="col-lg-8 " id="alert" style="display:none">
                <div class="alert alert-info alert-dismissable" id="textAlert"> <a class="panel-close close" data-dismiss="alert">×</a> This is an <strong>.alert</strong>. Use this to show important messages to the user. </div>
            </div>
            <div class="col-lg-8 order-lg-1 personal-info">
                <form role="form" id="formEditUser">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Name</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" value="<?php echo $name;?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="email" value="<?php echo $email;?>" />
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Current password</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="password" value="" id="currentPassword"/>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">New password</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="password" value="" id="newPassword"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Confirm new password</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="password" value="" id="confirmNewPassword"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-9 ml-auto text-right">
                            <input type="reset" class="btn btn-outline-secondary" value="Cancel" />
                            <input type="button" class="btn btn-primary" value="Save Changes" onclick="checkNewPassword()" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 order-lg-0 text-center">
                <img src="//api.adorable.io/avatars/120/trickst3r.png" class="mx-auto img-fluid rounded-circle" alt="avatar" />
                <h6 class="my-4">Upload a new photo</h6>
                <div class="input-group px-lg-4">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02">
                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-secondary"><i class="fa fa-upload"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>