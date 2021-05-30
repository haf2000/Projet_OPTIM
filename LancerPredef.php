<?php 
set_time_limit(100000); 

/*********************************** CODE DYNAMIQUE *********************************************/
/*Définition de la classe objet*/
class item
{
  function __construct( $weight) 
    {
      $this->weight = $weight;
    }
  #retourne le poid de l'objet 
  function getWeight(){return $this->weight;}
  #
}

/*  définition de la classe bin*/

class bin
{
  function __construct($capacity) 
    {
      $this->capacity = $capacity ; 
      $this->items = array();
        $this->utilization = 0;   
        
    }

#retourne la capacité

  function getCapacity(){

    return $this->capacity;
  }

#retourne la liste des objets 

  function getItems(){return $this->items;}


#retourne le poid total dans le bin 

    function getTotalWeight()
    { $total = 0 ;
      if (count($this->items) > 0) 
        {       
          for ($p=0; $p<count($this->items); $p++) 
          {
            $total = $total + $this->items[$p];
          }
        }
       return $total;
    }

#retourne le pourcentage de l'utilisation du bin 

   function getUtilisation(){

        $total = $this-> getTotalWeight() ;
      
       return round(($total / $this->capacity) * 100, 2);

   }  

    function push($item){

      array_push($this->items,$item);  
      ksort($this->items);
  }
  
   
}

/**************************************************/
/****Définition de la classe Packer****************/

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

#générer la table de vérité 
  function getTV($capacity,$items)
    {   
      
            ksort($this->items);
      $tv = array(array());

         for ($i=0;$i<count($items);$i++)
          {
               for ($j=0; $j<$capacity+1; $j++) 
                {   
                    $tv[$i][$j]=true;
                }
          }
        for ($m=0;$m<count($this->items);$m++)
          {
          for ($j=0;$j<$this->capacity+1; $j++) 
              {         
                  if (!$m)
                     {
                      if (($j != $items[$m])) 
                        {                 
                          $tv[$m][$j] = false;}
                         }

                else
                  {
                    
                              if ($j < $items[$m])  {

                                $tv[$m][$j] =$tv[$m - 1][$j];
                              }
                              else {
                                if($j>0)  {$tv[$m][$j] = $tv[$m - 1][$j] || $tv[$m - 1][$j - $items[$m]];}
                              }
                          }
                    }
          }
        return $tv; 

    }


 #récupérer les objets 

  function pickItems($tv)
  {   
    ksort($this->items);

    $choix = array();
    $k= (count($tv)) - 1;
    $j=0;
  if($k>=0){
    for ($index=0;$index < count($tv[$k]);$index++)
      {
        if(($tv[$k][$index]) == true){

           $j=$index;

        }

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
                          $j = $j - $this->items[$k];
                        }
                  }
                    $k = $k - 1 ;
                } }         
        return $choix;

  }


#ranger un objet 
  function moveItemsToBin($itemIndices, $binIndex)
  {   ksort($this->items);
    for ($i=0;$i<count($itemIndices);$i++)
      {
        array_push($this->bins[$binIndex]->items,$this->items[$i]);
        array_splice($this->items,$i,1);
        ksort($this->items);

      }
   
  }
  function packItems(){
    ksort($this->items);
    $nb = count($this->bins);
    if(count($this->bins) > 0)
      {       
        for ($i=0;$i<count($this->bins);$i++) 
          {
            $uti = $this->bins[$i]->getTotalWeight();
            if(($uti < $this->capacity) )
            {
              $capacityRest= $this->bins[$i]->capacity - $this->bins[$i]->getTotalWeight(); 
              $m = $this->getTV($capacityRest,$this->items);
              $picked_items = $this->pickItems($m); 
              for ($p=0;$p<count($picked_items);$p++)
                        {           
                           $this->bins[$i]->push($this->items[$picked_items[$p]]);
                      
                          array_splice($this->items,$picked_items[$p],1); 
                            ksort($this->bins[$binIndex]->items);
}}
          }
      }

       #ajouter une nouvelle boite 
    while(count($this->items) > 0)
      {  ksort($this->items);
        $m = $this->getTV($this->capacity,$this->items);    
        $newBin = new bin($this->capacity);
        array_push($this->bins, $newBin); 
        $binIndex =(count($this->bins) - 1);
        $pickedItems = $this->pickItems($m);
        for ($i=0;$i<count($pickedItems);$i++)
              { 
                
                 $this->bins[$binIndex]->push($this->items[$pickedItems[$i]]);                    
                   array_splice($this->items,$pickedItems[$i],1); 
                                  ksort($this->bins[$binIndex]->items);

              } 


      }

    }


} 


/************************************** CODE B&B ************************************************/
class Node
{
  public $level;
  public $nbBoxes;
  public $wremaining ;
  public function __construct($wremaining,$level,$nbBoxes)
  {
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


/*************************************  Debut ********************************************************/
$l = count($w);
for ( $k = 0 ; $k < $l; $k++){ 

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



/************************************** test ************************************************/

function read_inst($nom){
  $ressource = fopen('assets/Scholl/instances_predefinies/'.$nom, 'rb'); 
  $liste_poids_objets=array();
   $i = 0;
   while(!feof($ressource)){
    $p = fgets($ressource);
    if($i == 0 ){
      $nombre_objets = intval($p);
    }
    if($i == 1 ){
      $capacite = intval($p);
    }
    if($i >= 2){
       $val = intval($p);
       if($val != 0 ){
        $liste_poids_objets[$i-2] = $val;
       }
    }
     $i++;
   }


    $structure = array(
    "nom_inst" =>  $nom,
    "capacite" => $capacite ,
    "nombre_objets" => $nombre_objets,
    "liste_poids_objets" => $liste_poids_objets
  );
  return $structure;
}

$noms = array("1.txt","2.txt","3.txt","4.txt","5.txt","6.txt","7.txt");
$solBB = array();
$tempsBB = array();
$solDP = array();
$tempsDP = array();
$optimaux = array(3,3,5,7,8,11,9);
$capacites = array();
$nombre_objects = array();
$noms_i = array();

for ($i=0; $i < count($noms) ; $i++) { 
	$struc = read_inst($noms[$i]);
  $nom_i = $struc["nom_inst"];
	$nomb_obj = $struc["nombre_objets"];
	$cap = $struc["capacite"];
	$liste_obj = $struc["liste_poids_objets"];
     
     $capacites[$i] = $cap;
     $nombre_objects[$i] = $nomb_obj;
     $noms_i[$i] = $nom_i;

	// lancer Branch & Bound
     $timestart=microtime(true);
  $solBB[$i]  = branch_bound($liste_obj,$nomb_obj,$cap);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsBB[$i] = number_format($time, 5);

	// lancer dynamique
    $timestart=microtime(true);
	$packer = new Binpacker($cap); // capacité 
	$packer->setItems($liste_obj);
	$packer->packItems();
 	$solDP[$i] = count($packer->bins);
 	$timeend=microtime(true);
   $time=$timeend-$timestart;
   $tempsDP[$i] = number_format($time, 5);

}

$BB_sol = json_encode($solBB);
$BB_temps = json_encode($tempsBB);
$DP_sol = json_encode($solDP);
$DP_temps = json_encode($tempsDP);
$OPT = json_encode($optimaux);
$capacities = json_encode($capacites);
$objects = json_encode($nombre_objects);
$names = json_encode($noms_i);

$arr = array($BB_sol,$BB_temps,$DP_sol,$DP_temps,$OPT,$capacities,$objects,$names);
echo json_encode($arr);

?>