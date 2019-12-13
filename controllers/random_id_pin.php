<?php

function randomID(){

  $num = rand(1,100000);

  return $num;
}


function randomPin(){

  $digits = 5;
  $pin = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

  return $pin;
}

function saveQuestionImage($image){
  $target_dir = '../public/img/imatges_kahoot/';
  $target_file = $target_dir . basename($image["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($image["tmp_name"]);
    if($check !== false) {
      //echo "File is an image - " . $check["mime"] . ".";
      move_uploaded_file($image["tmp_name"], $target_dir . $newImageName);
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
}
  // function saveQuestionImage($image){
  //   $target_dir = '../public/img/imatges_kahoot/';
  //   $target_file = $target_dir . basename($_FILES["customFile"]["name"]);
  //   $uploadOk = 1;
  //   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  //   // Check if image file is a actual image or fake image
  //   if(isset($_POST["submit"])) {
  //     $check = getimagesize($_FILES["customFile"]["tmp_name"]);
  //     if($check !== false) {
  //       echo "File is an image - " . $check["mime"] . ".";
  //       $uploadOk = 1;
  //     } else {
  //       echo "File is not an image.";
  //       $uploadOk = 0;
  //     }
  //   }


  ?>
