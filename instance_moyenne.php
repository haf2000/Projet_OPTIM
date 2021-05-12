<?php 
    
 include "methode.php";
    
function lire_instance_moyenne($instance){
 /*
Les instances reçoivent des noms "NxWyBzRv.BPP" où
x = 1 (pour n = 50), x = 2 (n = 100), x = 3 (n = 200), x = 4 (n = 500)
y = 1 (pour poids moyen = c / 3), y = 2 (c / 5), y = 3 (c / 7), y = 4 (c / 9)
z = 1 (pour delta = 20%), z = 2 (50%), z = 3 (90%)
v = 0..9 pour les 10 instances de chaque classe
 */
  $ressource = fopen('assets/Scholl/Scholl_2/'.$instance, 'rb'); 
$liste_poids_objets=array();
 $N = substr($instance,0, -10); // retourne N1/N2/N3/N4
  $W = substr($instance,2, -8); // retourne W1,W2,W3,W4
  $B = substr($instance,4, -6); // retourne B1,B2,B3,B4
  $R = substr($instance,6, -4); // retourne R0..R9
 $instanceNAME =  substr($instance,0, -4);


  $cap_bin = 1000;

  if($W == "W1"){
    $poids_moyen = floor($cap_bin/3);
  }
  if($W == "W2"){
    $poids_moyen = floor($cap_bin/5);
  }
  if($W == "W3"){
    $poids_moyen = floor($cap_bin/7) ;
  }
  if($W == "W4"){
    $poids_moyen = floor($cap_bin/9);
  }

if($B == "B1"){
    $delta = 20/100;
  }
  if($B == "B2"){
    $delta = 50/100;
  }
  if($B == "B3"){
    $delta = 90/100;
  }

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
    "poids_moyen" => $poids_moyen,
    "delta" => $delta,
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
   $structure = lire_instance_moyenne($inst);
  
  // recuperer les paramètres
  $instance_name = $structure["nom_inst"];
  $capacite = $structure["capacite"];
  $nombre_objets = $structure["nombre_objets"];
  $liste_obj = $structure["liste_poids_objets"];
  $poids_moyen = $structure["poids_moyen"];
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

$sql = "INSERT INTO `resultats`(`nom_instance`,`solBB`, `tempsBB`, `solBF`, `tempsBF`, `solNF`, `tempsNF`, `type_instance`, `poids_moyen`, `capacite`, `nombre_objets` ) VALUES ('$instance_name','$solBB','$tempsBB', '$solBF' , '$tempsBF' ,'$solNF','$tempsNF','1', '$poids_moyen', '$capacite','$nombre_objets')";

if ($conn->query($sql) === TRUE) {
  echo "element inséré !";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
   $conn->close();
   die();      
    }


 ?>