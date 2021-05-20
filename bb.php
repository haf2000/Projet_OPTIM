<?php 

set_time_limit(1000); 

function Branch_Bound($items,$n,$c){
// initialiser la valeur optimale
   $minboxes = $n;
  //Tableau des poids restants
   $wremaining = array();
   for($j=0;$j<$n;$j++){
    $wremaining[$j] = $c;
   }
   //Nb boites utilisées
   $numboxes = 0;

   $s = 0;
   $insert = false;
   $i = 0;
   $cpt = 0;
//on parcourt la liste des objets

 for($k=0;$k<$n;$k++){
    $insert = false;
    $x = $items[$k];
    if ($items[$k] > $c){
      print("le poids d'un objet ne doit pas dépasser la capacité d'une boite");
    //  return 0;
      }
    else{

     $i=0;
    while($insert == false and $i<$n){
        // echo "<br> wremaining[$i]".$wremaining[$i];
        // echo " | items[$k]".$items[$k];
        if($wremaining[$i] > $items[$k]){
          $wremaining[$i] = $wremaining[$i] - $items[$k];
          if($i> $cpt){
            $cpt++;
          }
          $insert = true;
          
          }
        else{
          $i++;
        }
    }
    }
  }

return $cpt+1;
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

     // BRANCH & BOUND
  $timestart=microtime(true);
  $solBB = Branch_Bound($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsBB = number_format($time, 5);



if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solBB`='$solBB',`tempsBB`= '$tempsBB' WHERE id='$id'";
}else{
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solBB`='$solBB',`tempsBB`= '$tempsBB' WHERE id='$id'";
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