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

if($instance_name == "HARD0.txt"){
$sol_OPT = 56;
}else{
	if($instance_name == "HARD2.txt"){
$sol_OPT = 56;
}else{
	$sol_OPT = 0;
}
}
$sql = "INSERT INTO `resultats`(`nom_instance`, `type_instance`,`solution_optimale`) VALUES ('$instance_name','2','$sol_OPT')";

if ($conn->query($sql) === TRUE) {
  echo "element inséré !";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

  $conn->close();
   die();      
    }



 ?>