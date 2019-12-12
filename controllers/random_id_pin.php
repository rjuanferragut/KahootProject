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

// function upload_img($img){
//   $ruta_base   = "../public/img/imatges_kahoot/";
//   $archivo     = $ruta_base . basename( $_FILES["ent_reg"]["name"] );
//   $Ok          = 1;
//   $tipo_imagen = pathinfo( $archivo, PATHINFO_EXTENSION );
//
//   //comprueba que es una imagen
//   if ( isset( $_POST["submit"] ) ) {
//     $check = getimagesize( $_FILES["ent_reg"]["tmp_name"] );
//     if ( $check !== false ) {
//       echo "Es una imagen - " . $check["mime"] . ".";
//       $Ok = 1;
//     } else {
//       echo "No es una imagen.";
//       $Ok = 0;
//     }
//   }
//
//   //comprueba si existe
//   if ( file_exists( $archivo ) ) {
//     echo "El archivo ya existe.";
//     $Ok = 0;
//   }
//
//   //valida la extensión
//   if ( $tipo_imagen != "jpg" && $tipo_imagen != "png" && $tipo_imagen != "jpeg" && $tipo_imagen != "gif" ) {
//     echo "Solo aceptamos extensiones JPG, JPEG, PNG & GIF.";
//     $Ok = 0;
//   }
//
//   //Sube el archivo, si se ha recibido un archivo válido
//   if ( $Ok == 0 ) {
//     echo "El archivo no ha sido subido, lo sentimos.";
//   } else {
//     if ( move_uploaded_file( $_FILES["ent_reg"]["tmp_name"], $archivo ) ) {
//       echo "El archivo " . basename( $_FILES["ent_reg"]["name"] ) . " ha sido subido.";
//     } else {
//       echo "Lo sentimos, ha habido un error subiendo el archivo.";
//     }
//   }
// }

?>
