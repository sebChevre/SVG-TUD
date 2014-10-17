<?php


try {
 $dns = 'mysql:host=localhost;dbname=tud;charset=utf8';
  $utilisateur = 'root';
  $motDePasse = '';
  $connection = new PDO( $dns, $utilisateur, $motDePasse );
} catch ( Exception $e ) {
  echo "Connection à MySQL impossible : ", $e->getMessage();
  die();
}


?>
