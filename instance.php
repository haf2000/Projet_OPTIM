<?php  

include "methode.php";

function lire_instance_difficile($instance){
 /*
parameter values
n 200
c 100000
wj  from [20000,35000] for j=1,...,n

 */
  $ressource = fopen('assets/Scholl/Scholl_3/'.$instance, 'rb'); 
$liste_poids_objets=array();
  $cap_bin = 100000;
  $poids_max = 35000;
  $poids_min = 20000;
   $instanceNAME =  substr($instance,0, -4);

   $i = 0;
   while(!feof($ressource)){
    $p = fgets($ressource);
     $liste_poids_objets[$i] = $p;
     $i++;
   }

  $Nbr_objets = count($liste_poids_objets)-1;
  
  $structure = array(
       "nom_inst" =>  $instanceNAME,
    "capacite" => $cap_bin ,
    "nombre_objets" => $Nbr_objets,
    "poids_min" => $poids_min,
    "poids_max" => $poids_max,
    "liste_poids_objets" => $liste_poids_objets
  );

return $structure;
}
  ///////////////////////////////////////////////
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "optim";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//-------------------------------------------------------------------------
   if(isset($_POST['inst'])) {
   $inst = $_POST['inst']; 
   $structure = lire_instance_difficile($inst);
   // recuperer les paramètres
  $instance_name = $structure["nom_inst"];
  $capacite = $structure["capacite"];
  $nombre_objets = $structure["nombre_objets"];
  $liste_obj = $structure["liste_poids_objets"];
  $poids_min = $structure["poids_min"];
  $poids_max = $structure["poids_max"];

  // lancer les méthodes et sauvegarder les résultats
     // BEST FIT
  $timestart=microtime(true);
  $solBF = BesfFit($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsBF = number_format($time, 3);
    

    // NEXT FIT
  $timestart=microtime(true);
  $solNF = NextFit($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsNF = number_format($time, 3);
  

     // BRANCH & BOUND
  $timestart=microtime(true);
  $solBB = Branch_Bound($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsBB = number_format($time, 3);

$sql = "INSERT INTO `resultats`(`nom_instance`,`solBB`, `tempsBB`, `solBF`, `tempsBF`, `solNF`, `tempsNF`, `type_instance`, `poids_min`, `poids_max`, `capacite`, `nombre_objets` ) VALUES ('$instance_name','$solBB','$tempsBB', '$solBF' , '$tempsBF' ,'$solNF','$tempsNF','2', '$poids_min','$poids_max', '$capacite','$nombre_objets')";

if ($conn->query($sql) === TRUE) {
  echo "element inséré !";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
   $conn->close();
   die();      
    }
//-------------------------------------------------------------------------
?>