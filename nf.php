<?php 
 
set_time_limit(1000); 

function NextFit($weight, $nbrit, $capacity){
  
  // initialiser le res nbr de bins
  // act_cap represente la capacité actuelle dans le bin actuel
  $res = 1;
  $act_cap = $capacity;

  for ($i = 0; $i < $nbrit; $i++) {
    //parcourir les items
    // Si l'item ne peut etre place dans le bin acutel
    if ($weight[$i] > $act_cap) {
      $res++; // ajouter un nouveau bin
      $act_cap = $capacity - $weight[$i]; //màj la capacité actuelle
      
    } //on le place dans le bin
    else $act_cap -= $weight[$i];

  }
  return $res; //retourner le nbr de bins requis

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
        $solution_ex = $row["solNF"]; $temps_ex = $row["tempsNF"];
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
  $solNF = NextFit($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsNF = number_format($time, 5);


  
if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solNF`='$solNF',`tempsNF`= '$tempsNF' WHERE id='$id'";
}else{
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solNF`='$solNF',`tempsNF`= '$tempsNF' WHERE id='$id'";
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
