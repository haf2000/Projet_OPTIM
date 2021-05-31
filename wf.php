<?php 
set_time_limit(1000); 


function worstFit($weight,$n, $c)
{
	// Initialize result (Count of bins)
	$res = 0;

	$bin_rem = array();

	// Place items one by one
	for ($i = 0; $i < $n; $i++) {

		$mx = -1;
		$wi = 0;

		for ($j = 0; $j < $res; $j++) {
			if ($bin_rem[$j] >= $weight[$i] and $bin_rem[$j]-$weight[$i] > $mx) {
				$wi = $j;
				$mx = $bin_rem[$j] - $weight[$i];
			}
		}

		// If no bin could accommodate weight[i],
		// create a new bin
		if ($mx == -1) {
			$bin_rem[$res] = $c - $weight[$i];
			$res++;
		}
		else // Assign the item to best bin
			$bin_rem[$wi] -= $weight[$i];
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
  
     $solution_ex = $row["solWF"]; $temps_ex = $row["tempsWF"];
if($solution_ex == 0 and $temps_ex == 0){
    
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
      if($type == '2'){
        $structure = lire_instance_difficile($row["nom_instance"]);
        $poids_min = $structure["poids_min"];
      $poids_max = $structure["poids_max"]; 
      }else{
       if($type == '3'){
         $structure = lire_instance_U($row["nom_instance"]);
       }else{
         $structure = lire_instance_T($row["nom_instance"]);
       }
      }
             
    }
  }
  // recuperer les paramètres
  $capacite = $structure["capacite"];
  $nombre_objets = $structure["nombre_objets"];
  $liste_obj = $structure["liste_poids_objets"];

  // Lancer Worst Fit
 $timestart=microtime(true);
  $solWF = worstFit($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsWF = number_format($time, 5);


if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solWF`='$solWF',`tempsWF`= '$tempsWF' WHERE id='$id'";
}else{
  if($type == '1'){
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solWF`='$solWF',`tempsWF`= '$tempsWF' WHERE id='$id'";
  }else{
    // classe U ou T
    $sql = "UPDATE resultats SET `capacite`='$capacite',`nombre_objets`='$nombre_objets',`solWF`='$solWF',`tempsWF`= '$tempsWF' WHERE id='$id'";
  }

}




if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

}

  }
} else {
  echo "0 results";
}

$conn->close();

 ?>