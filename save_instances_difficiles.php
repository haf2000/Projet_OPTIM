<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "optim";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	echo "lol";
  die("Connection failed: " . $conn->connect_error);
}
  //  echo "Connected successfully";
 if(isset($_POST['inst'])) {

$instance_name = $_POST['inst']; 
$sql = "INSERT INTO `resultats`(`nom_instance`, `type_instance`) VALUES ('$instance_name','2')";

if ($conn->query($sql) === TRUE) {
  echo "element inséré !";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

  $conn->close();
   die();      
    }



 ?>