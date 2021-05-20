<?php 
 
set_time_limit(1000); 


// **********************************************************************
function BesfFit($weight,$n,$capacity){
//weight : tableau des objets
// n : nombre d objets
// capacity : capacité du bin 

  // Initialiser le nombre de bin à 0
  $res = 0;
   //   Créer un tableau pour stocker l'espace restant dans les bins
   $bin_remp = array();
       for ($i = 0; $i < $n; $i++) { // pour chaque objet
           // Trouvez le premier bac qui peut supporter le weight[i]
           $j = 0;
           // Initialiser l'espace minimum restant et l'index du meilleur bin

         $min = $capacity + 1;
         $bi = 0;  

         for ($j = 0; $j < $res; $j++) {
          if ($bin_remp[$j] >= $weight[$i] and ($bin_remp[$j] - $weight[$i])< $min){

            $bi = $j;
                $min = $bin_remp[$j] - $weight[$i];
          }
                    
         }
           // Si aucun bin ne pouvait accueillir weight[i],
           // créer un nouveau bin
            if ($min == $capacity + 1){
              $bin_remp[$res] = $capacity - $weight[$i];
                $res += 1;
            }
                
            else // Attribuer l'article au meilleur bin
              {
                $bin_remp[$bi] -= $weight[$i];
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

  // Lancer Best Fit
 $timestart=microtime(true);
  $solBF = BesfFit($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsBF = number_format($time, 5);


if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solBF`='$solBF',`tempsBF`= '$tempsBF' WHERE id='$id'";
}else{
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solBF`='$solBF',`tempsBF`= '$tempsBF' WHERE id='$id'";
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
