<?php         
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
   $structure = lire_instance_difficile($inst);
   $str =  json_encode($structure);
   echo $str;
   die();      
    }
//-------------------------------------------------------------------------
?>