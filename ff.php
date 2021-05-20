<?php 

set_time_limit(1000); 

function firstFit($weight,$n,$c)
{
	// Initialize result (Count of bins)
	$res = 0;

	// Create an array to store remaining space in bins
	// there can be at most n bins
	$bin_rem = array();

	// Place items one by one
	for ($i = 0; $i < $n; $i++)
	{
		// Find the first bin that can accommodate
		// weight[i]
	for ($j = 0; $j < $res; $j++)
		{
			if ($bin_rem[$j] >= $weight[$i])
			{
				$bin_rem[$j] = $bin_rem[$j] - $weight[$i];
				break;
			}
		}

		// If no bin could accommodate weight[i]
		if ($j == $res)
		{
			$bin_rem[$res] = $c-$weight[$i];
			$res++;
		}
	}
	return $res;
}
	

include "lire_instances.php";

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



$sql = "SELECT * FROM `resultats` WHERE 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  
    
  $id = $row["id"];
  $type = $row["type_instance"];
  if($type == '0'){
     $structure = lire_instance_facile($row["nom_instance"]);  
      $poids_min = $structure["poids_min"];
  $poids_max = $structure["poids_max"]; 
  }else{
    if($type == '1'){
       $structure = lire_instance_moyenne($row["nom_instance"]);  
       $poids_moyen = $structure["poids_moyen"];
    }else{
       $structure = lire_instance_difficile($row["nom_instance"]);
        $poids_min = $structure["poids_min"];
  $poids_max = $structure["poids_max"];       
    }
  }
  // recuperer les paramètres
  $capacite = $structure["capacite"];
  $nombre_objets = $structure["nombre_objets"];
  $liste_obj = $structure["liste_poids_objets"];

  // Lancer Next Fit
 $timestart=microtime(true);
  $solFF = firstFit($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsFF = number_format($time, 5);


  
if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solFF`='$solFF',`tempsFF`= '$tempsFF' WHERE id='$id'";
}else{
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solFF`='$solFF',`tempsFF`= '$tempsFF' WHERE id='$id'";
}



if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}





  }
} else {
  echo "0 results";
}

$conn->close();





 ?>