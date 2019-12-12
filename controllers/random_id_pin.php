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

    function upload_img($img){
      $uploaddir = '../public/img/imatges_kahoot/';
      $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
      move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
      echo "<p>";

      if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        echo "File is valid, and was successfully uploaded.\n";
      } else {
        echo "Upload failed";
      }

    }

?>
