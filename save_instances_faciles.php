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
if($instance_name == "N1C1W1_R.txt"){
  $sol_OPT =  25;
}else{
   if($instance_name == "N1C3W1_A.txt"){
   	$sol_OPT =  16;
   }else{
   if($instance_name == "N2C1W2_Q.txt"){
   	$sol_OPT =  65;
   }else{
      if($instance_name == "N2C3W1_A.txt"){
      	$sol_OPT = 35;
      }else{
      	if($instance_name == "N3C1W1_A.txt"){
      	$sol_OPT = 105;
      }else{
      	if($instance_name == "N3C3W1_A.txt"){
      		$sol_OPT = 66;
      	}else{

      		if($instance_name == "N4C1W2_H.txt"){
      		$sol_OPT = 315;
      	}else{
      		if($instance_name == "N4C3W1_A.txt"){
      		$sol_OPT = 164;
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

$sql = "INSERT INTO `resultats`(`nom_instance`, `type_instance`,`solution_optimale`) VALUES ('$instance_name','0','$sol_OPT')";

if ($conn->query($sql) === TRUE) {
  echo "element inséré !";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

  $conn->close();
   die();      
    }



 ?>