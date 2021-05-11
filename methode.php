<?php 
function Branch_Bound($weight,$n,$capacity){
    $minBoxes = $n; # initialiser la valeur optimale de boites à n
    $Nodes = [];  # les noeuds à traiter
    $wRemaining = [$capacity]*$n;  # initialiser les poids restants dans chaque boite [c,c,c,.......c]
    $numBoxes = 0;  # initialiser le nombre de boites utilisées

 for($k=0; $k < $n; $k++){
   if($weight[$k] > $capacity){
     print("les poids des objets ne doivent pas dépasser la capacité du bin");
     return 0;
   }else{


   }
 }
    

  // for k in range(len(w)):

  //           else:
  //               print(n, n)
  //               curN = bin.Node(wRemaining, 0,
  //                               numBoxes)  # créer le premier noeud, niveau 0, nombre de boites utilisées 0

  //               Nodes.append(curN)  # ajouter le noeud à l'arbre

  //               while len(Nodes) > 0:  # tant qu'on a un noeud à traiter

  //                   curN = Nodes.pop()  # récupérrer un noeud pour le traiter (curN)
  //                   curLevel = curN.getLevel()  # récupérrer son niveau

  //                   if (curLevel == n) and (
  //                           curN.getNumberBoxes() < minBoxes):  # si c'est une feuille et nbr boites utilisées < minBoxes
  //                       minBoxes = curN.getNumberBoxes()  # umettre à jour minBoxes

  //                   else:

  //                       indNewBox = curN.getNumberBoxes()

  //                       if (indNewBox < minBoxes):

  //                           wCurLevel = w[curLevel]
  //                           for i in range(indNewBox + 1):
  //                               if (curLevel < n) and (curN.getWRemaining(
  //                                       i) >= wCurLevel):  # si cet possible d'insérer l'objet dans la boite i
  //                                   # on crée un nouveau noeud.
  //                                   newWRemaining = curN.getWRemainings().copy()
  //                                   newWRemaining[i] -= wCurLevel  # la capacité restante i - le poids du nouvel objet

  //                                   if (i == indNewBox):  # nouvelle boite
  //                                       newNode = bin.Node(newWRemaining, curLevel + 1, indNewBox + 1)
  //                                       for j in range(curLevel + 1, len(w)):
  //                                           s = + w[j]
  //                                       if (((indNewBox + 1) + s / c) < minBoxes):
  //                                           Nodes.append(newNode)
  //                                   else:  # boite deja ouverte
  //                                       newNode = bin.Node(newWRemaining, curLevel + 1, indNewBox)
  //                                       for j in range(curLevel + 1, len(w)):
  //                                           s = + w[j]
  //                                       if ((indNewBox + s / c) < minBoxes):
  //                                           Nodes.append(newNode)

  //               return minBoxes
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