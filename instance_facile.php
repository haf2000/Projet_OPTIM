<?php 

include "methode.php";

function lire_instance_facile($instance){
  $ressource = fopen('assets/Scholl/Scholl_1/'.$instance, 'rb'); 
  //Nombre d'objets (N1 = 50, N2 = 100, N3 = 200, N4 = 500)
  //Capacité des bins (C=1000)
  //W : Intervalle des poids des objets (W1 = [1, 100], W2 = [20, 100], W4 = [30, 100])  
  
  $liste_poids_objets=array();
 $N = substr($instance,0, -10); // retourne N1/N2/N3/N4
  $C = substr($instance,2, -8); // retourne C1/C2/C3
  $W = substr($instance,4, -6); // retourne W1,W2,W4
 $instanceNAME =  substr($instance,0, -4);

  if($C == "C1") $cap_bin =100;
  if($C == "C2") $cap_bin =120;
  if($C == "C3") $cap_bin =150;

  if($W == "W1"){
    $poids_min = 1; $poids_max = 100;
  }
  if($W == "W2"){
    $poids_min = 20; $poids_max = 100;
  }
  if($W == "W4"){
    $poids_min = 30; $poids_max = 100;
  }


   $i = 0;
   while(!feof($ressource)){
     $liste_poids_objets[$i] = fgets($ressource);
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
  // $str =  json_encode($structure);
  // echo $structure
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
  //  echo "Connected successfully";



   if(isset($_POST['inst'])) {
  // recuperer le nom de l'instance
   $inst = $_POST['inst']; 
   $structure = lire_instance_facile($inst);
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


$sql = "INSERT INTO `resultats`(`nom_instance`,`solBB`, `tempsBB`, `solBF`, `tempsBF`, `solNF`, `tempsNF`, `type_instance`, `poids_min`, `poids_max`, `capacite`, `nombre_objets` ) VALUES ('$instance_name','$solBB','$tempsBB', '$solBF' , '$tempsBF' ,'$solNF','$tempsNF','0', '$poids_min','$poids_max', '$capacite','$nombre_objets')";

if ($conn->query($sql) === TRUE) {
  echo "element inséré !";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
   $conn->close();
   die();      
    }




 ?>