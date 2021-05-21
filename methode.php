<?php 
//liste des objets 
  //items = [5,5,4,15,7,8,1,10,6,12];
   //nombre d'objets à insérer
  // var n= items.length;

//ini_set('memory_limit', '-1');
ini_set('memory_limit', '512M');
set_time_limit(1000); 


function worstFit($weight,$n, $c)
{
  // Initialize result (Count of bins)
  $res = 0;

  $bin_rem = array();

  // Place items one by one
  for ($i = 0; $i < $n; $i++) {

    $mx = -1;
    $wi = 0;

    for ($j = 0; $j < $res; $j++) {
      if ($bin_rem[$j] >= $weight[$i] and $bin_rem[$j]-$weight[$i] > $mx) {
        $wi = $j;
        $mx = $bin_rem[$j] - $weight[$i];
      }
    }

    // If no bin could accommodate weight[i],
    // create a new bin
    if ($mx == -1) {
      $bin_rem[$res] = $c - $weight[$i];
      $res++;
    }
    else // Assign the item to best bin
      $bin_rem[$wi] -= $weight[$i];
  }
  return $res;
}



function firstFit($weight,$n,$c)
{
  // Initialize result (Count of bins)
  $res = 0;

  // Create an array to store remaining space in bins
  // there can be at most n bins
  $bin_rem = array();

  // Place items one by one
  for ($i = 0; $i < $n; $i++)
  {
    // Find the first bin that can accommodate
    // weight[i]
  for ($j = 0; $j < $res; $j++)
    {
      if ($bin_rem[$j] >= $weight[$i])
      {
        $bin_rem[$j] = $bin_rem[$j] - $weight[$i];
        break;
      }
    }

    // If no bin could accommodate weight[i]
    if ($j == $res)
    {
      $bin_rem[$res] = $c-$weight[$i];
      $res++;
    }
  }
  return $res;
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

/**************************** PROGRAMMATION DYNAMIQUE **********************************/


class item
{
  function __construct($name, $weight) 
    {
      $this->name = $name ;
      $this->weight = $weight;
    }
  function getName(){return $this->name;}
  function getWeight(){return $this->weight;}
  function Inf($objet){return $this->weight < $objet->weight ;}
  function Egal($objet){return $this->weight == $objet->weight ;}
}

/***********************************************************************/
class bin
{
  function __construct($name, $capacity) 
    {
      $this->capacity = $capacity ;
      $this->name = $name;  
      $this->items = array();
        $this->utilization = 0.0;   
        $this->tow = 0;
    }
    

   function getName(){return $this->name;}
   function getCapacity(){return $this->capacity;}
   function getTotalWeight()
    { $total = 0 ;
      if (count($this->items) > 0) 
        {       
          for ($p=0; $p<count($this->items); $p++) 
          {
            $total = $total + $this->items[$p]->weight;
          }
        }
       return $total;
    }
   function getUtilization(){return $this->utilization;}
   function push($item)
    {
      array_push($this->items,$item);
      $t = $this->getTotalWeight();
      $this->utilization = round(($t / $this->capacity) * 100, 2);
      $this->tow = $t;
    }
   //pop
   //remove 
   function getItems(){return $this->items;}
}
/***********************************************************************/
class Binpacker 
{
  function __construct($capacity) 
    {
          $this->capacity = $capacity;
          $this->bins = array();
          $this->items = array();
    }
  function getItems(){return $this->items;}
  function setItems($items){$this->items=$items;}
  function addItem($item){array_push($this->items,$item);}
  function getBins(){return $this->bins;}
  function setBins($bins){$this->bins=$bins;}
  function getTV($capacity,$items)
    {
      $tv = array(array());
      $ll = count((array)$items);
         for ($i=0;$i<$ll;$i++)
          {
               for ($j=0; $j<$capacity+1; $j++) 
                {   
                    $tv[$i][$j]=true;
                }
          }
      $ll2 = count((array)$items);
        for ($i=0;$i<$ll2;$i++)
          {
          for ($j=0;$j<$capacity+1; $j++) 
              {         
                  if ($i==0)
                     {
                      if ($j != $items[$i]->weight && $j > 0) 
                        {                 
                          $tv[$i][$j] = false;}
                         }

                else
                  {
                    
                            if ($j < $items[$i]->weight) {$tv[$i][$j] =$tv[$i - 1][$j];}
                            else {$tv[$i][$j] = $tv[$i - 1][$j] || $tv[$i - 1][$j - $items[$i]->weight];}
                          }
                    }
          }
        return $tv; 

    }
  function pickItems($tv)
  {
    $choix = array();
    $k= (count($tv)) - 1;
    $j=0;
    $limit = count($tv[$k]);
    for ($index=0;$index < $limit;$index++)
      {
        if(($tv[$k][$index]) == true) $j=$index;
      }
    while ($k >= 0)
                {
                  if ($k == 0) 
                     {
                      if ($j > 0) {array_push($choix,$k);}
                       }
                  else
                  {
                    if ($tv[$k - 1][$j] == false)
                      {
                          
                          array_push($choix,$k);
                          $j = $j - $this->items[$k]->weight;
                        }
                  }
                    $k = $k - 1 ;
                }  
        
        return $choix;

  }

  function packItems(){
    asort($this->items);
    $nb = count($this->bins);
    if($nb > 0)
      {       
        for ($i=0;$i<$nb;$i++) 
          {
            $uti = $this->bins[$i]->utilization;
            $num_items = count($this->items);
            if(($uti != 100) && ( $num_items > 0))
            {
              $capacityRest= $this->bins[$i]->capacity - $this->bins[$i]->tow;  
              $m = $this->getTV($capacityRest,$this->items);
              $picked_items = $this->pickItems($m); 
              $len_picked_items = count($picked_items);
              for ($p=0;$p< $len_picked_items;$p++)
                        {           
                           $this->bins[$i]->push($this->items[$picked_items[$p]]);
                        }
              for ($d=0;$d<$len_picked_items;$d++)
                        {
                          array_splice($this->items,$picked_items[$d],1); 
                        }       
            }

          }
      }


    while(count($this->items) > 0)
      { 
        $m = $this->getTV($this->capacity,$this->items);    
        $newBin = new bin(count($this->bins),$this->capacity);
        array_push($this->bins, $newBin); 
        $binIndex = count($this->bins) - 1;
        $pickedItems = $this->pickItems($m);
       $len_picked_items = count($pickedItems);    
        for ($i=0;$i<$len_picked_items;$i++)
              { 
                
                 $this->bins[$binIndex]->push($this->items[$pickedItems[$i]]);                    
              }
          for ($i=0;$i<$len_picked_items;$i++)
              {
                array_splice($this->items,$pickedItems[$i],1);  
              }
          
      }

    }

  }
/*********************************************************************************/
class Node
{
  public  $level;
  public  $nbBoxes;
  public  $wremaining ;
  public function __construct(array $wremaining,int $level, int $nbBoxes)
  {
    # code...
    $this->level = $level;
    $this->nbBoxes = $nbBoxes;
    $this->wremaining = $wremaining;
  }
  public function getLevel()
    {
      return $this->level;
    }

  public function getNbBoxes()
    {
      return $this->nbBoxes;
    }
    public function getWremaining()
    {
      return $this->wremaining;
    }
}


 function branch_bound($w,$n,$c){

# paramètre qui sera utilisé dans la fonction d'évaluation
$s = 0;
# la valeur optimal initialisée à n qui est le nombre d'objets 
$optimal_value = $n;

// le tableau des noeuds a traiter, représente le parcours de l'arbre 
$list_nodes = array();

// le tableau contenant les boites et le poid restant dans chacune des boites 
$wremaining = array();
#on initialise la capacité des boites à C
for($i = 0; $i < $n; $i++){
  $wremaining[$i] = $c;
}

# début d'execution
$timestart=microtime(true);

/***********************************************************************Debut*********************************************************************************/

for ( $k = 0 ; $k < count($w); $k++){ 

      # on teste si le poid de l'objet ne dépasse pas la capacité 
      if($w[$k]> $c){

        echo 'le poid des objets ne doit pas dépasser la capacité';
      }

      # sinon 
      else{

       # on crée le premier noeud niveau 0 nombre de boites utilisées 0, ce noeud représente la racine de l'arbre 

        $currentNode = new Node($wremaining,0,0);

        #ajouter le noeud à l'arbre 
        array_push($list_nodes,$currentNode);

        $cnt = count($list_nodes);

        #Parcourt des noeuds pour les évaluer 
        while (count($list_nodes) > 0) {  

          # on récupère un noeud pour l'évaluer
          $currentNode = array_pop($list_nodes);
          # on récupère le niveau courant       
          $currentLevel = $currentNode->getLevel();   

          #si le noeud est une feuille 
          if( ($currentLevel == $n)&& ($currentNode->getNbBoxes() < $optimal_value)){
                 $optimal_value = $currentNode->getNbBoxes();

          }


          #si le noeud n'est pas une feuille 
            else{

               # on récupère le nombre de boite utilisées à partir du noeud courant 
               $IndiceBox = $currentNode->getNbBoxes();

               # si le nombre de boite utilisées est inférieure à la valeur optimal
               if( $IndiceBox < $optimal_value){

                    #on récupère le poid de l'objet du niveau courant 
                    $wcurrentLevel = $w[$currentLevel];

                    # on parcourt les boites utilisées  
                    for($i =0;$i < $IndiceBox+1;$i++){

                      #si c'est possible d'insérer l'objet dans la boite i ie le poid restant dans la boite i >= au poid de l'objet 
                      if(($currentLevel<$n)&&($currentNode->getWremaining()[$i] >= $wcurrentLevel)){

                                # On crée un nouveau noeud, en modifiant wremaining: on soustrait le poid de l'objet à insérer du poid resstant dans la boite 
                                  $newWremaing = array();
                                  $newWremaing = $currentNode->getWremaining();
                                  $newWremaing[$i] = $newWremaing[$i] - $wcurrentLevel;

                                  #on insère dans une nouvelle boite 
                                  if($i== $IndiceBox){
                                      
                                      #on crée un nouveau noeud avec : 
                                      $newNode = new Node($newWremaing,$currentLevel+1,$IndiceBox+1);
                                       $s=0;
                                       for($j= $currentLevel+1; $j < count($w); $j++){

                                             $s = $s + $w[$j];
                                       }

                                       
                                       if((($IndiceBox+1 + $s )/ $c) < $optimal_value){

                                        #on ajoute le noeud à la liste des noeuds à traiter 
                                        array_push($list_nodes, $newNode);

                                     }
                                
                                    
                                  }

                                  #on insère dans une boite déja existante 
                                  else{

                                      #on crée un nouveau noeud avec : 
                                      $newNode = new Node($newWremaing,$currentLevel+1,$IndiceBox);
                                       $s=0;
                                       for($j= $currentLevel+1; $j < count($w); $j++){

                                             $s = $s + $w[$j];
                                       }

                                       #
                                       if((($IndiceBox + $s) / $c)< $optimal_value){

                                        #on ajoute le noeud à la liste des noeuds à traiter 
                                        array_push($list_nodes, $newNode);
                                     }

                                  }


                      }
                    }
               }
            }

        
        }
    }
}

return $optimal_value;
 }
 ?>