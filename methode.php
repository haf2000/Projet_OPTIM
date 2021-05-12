<?php 
//liste des objets 
  //items = [5,5,4,15,7,8,1,10,6,12];
   //nombre d'objets à insérer
  // var n= items.length;

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
      return 0;
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
// **********************************************************************


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



 ?>