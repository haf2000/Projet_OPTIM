<?php 
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

 $Nbr_objets = count($liste_poids_objets);
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

//-------------------------------------------------------------------------
   if(isset($_POST['inst'])) {
   $inst = $_POST['inst']; 
   $structure = lire_instance_facile($inst);
   $str =  json_encode($structure);
   echo $str;
   die();      
    }




 ?>