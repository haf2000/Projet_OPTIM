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
 
  
  
 
if($instance_name == "N1W1B1R0.txt"){
  $sol_OPT = 18;
}else{
   if($instance_name == "N1W4B3R9.txt"){
  $sol_OPT = 6;
}else{
	if($instance_name == "N2W1B1R0.txt"){
  $sol_OPT = 34;
}else{
	if($instance_name == "N2W4B3R0.txt"){
  $sol_OPT = 12;
}else{
   if($instance_name == "N3W1B1R0.txt"){
  $sol_OPT = 67;
}else{
  if($instance_name == "N3W4B1R0.txt"){
  $sol_OPT = 23;
}else{
  if($instance_name == "N4W1B1R0.txt"){
  $sol_OPT = 167;
}else{
if($instance_name == "N4W4B3R9.txt"){
  $sol_OPT = 56;
}else{
$sol_OPT = 0;
}
}
}
}
}
}
}
}
$sql = "INSERT INTO `resultats`(`nom_instance`, `type_instance`,`solution_optimale`) VALUES ('$instance_name','1','$sol_OPT')";

if ($conn->query($sql) === TRUE) {
  echo "element inséré !";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

  $conn->close();
   die();      
    }



 ?>