<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "optim";
$connexion = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connexion->connect_error) {
  die("Connection failed: " . $connexion->connect_error);
}
$sql = "TRUNCATE TABLE resultats";


if ($connexion->query($sql) === TRUE) {
  echo "base de données vidée !";
} else {
  echo "Error: " . $sql . "<br>" . $connexion->error;
}


   $connexion->close();
 ?>