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
     $liste_poids_objets[$i] = intval(fgets($ressource));

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
     $liste_poids_objets[$i] = intval($p);
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
     $liste_poids_objets[$i] = intval($p);
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




 ?>