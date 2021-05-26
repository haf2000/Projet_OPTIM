<?php 


 
set_time_limit(1000); 
ini_set('memory_limit', '-1');


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
                    
                              if (($j < $items[$m]) &&( $j > 0)) {

                                $tv[$m][$j] =$tv[$m - 1][$j];
                              }
                              else {
                                $tv[$m][$j] = $tv[$m - 1][$j] || $tv[$m - 1][$j - $items[$m]];
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
 /**********************************************************************Test***********************************************************************************************/

include "lire_instances.php";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "optim";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	echo "lol";
  die("Connection failed: " . $conn->connect_error);
}
  //  echo "Connected successfully";


$sql = "SELECT * FROM `resultats` WHERE 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $solution_ex = $row["solDP"]; $temps_ex = $row["tempsDP"];
 if($solution_ex == 0 and $temps_ex == 0){
  $id = $row["id"];
  $type = $row["type_instance"];
  if($type == '0'){
     $structure = lire_instance_facile($row["nom_instance"]);  
      $poids_min = $structure["poids_min"];
  $poids_max = $structure["poids_max"]; 
  }else{
    if($type == '1'){
       $structure = lire_instance_moyenne($row["nom_instance"]);  
       $poids_moyen = $structure["poids_moyen"];
    }else{
       $structure = lire_instance_difficile($row["nom_instance"]);
        $poids_min = $structure["poids_min"];
  $poids_max = $structure["poids_max"];       
    }
  }
  // recuperer les paramètres
  $capacite = $structure["capacite"];
  $nombre_objets = $structure["nombre_objets"];
  $liste_obj = $structure["liste_poids_objets"];
   
   echo $nombre_objets;
   echo "capacite".$capacite;
// Programmation dynamique
   $timestart=microtime(true);

   $packer = new Binpacker($capacite); // capacité 
$packer->setItems($liste_obj);
$packer->packItems();
 $solDP = count($packer->bins);
 $timeend=microtime(true);
   $time=$timeend-$timestart;
   $tempsDP = number_format($time, 5);
   echo "sol : ".$solDP;



if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solDP`='$solDP',`tempsDP`= '$tempsDP' WHERE id='$id'";
}else{
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solDP`='$solDP',`tempsDP`= '$tempsDP' WHERE id='$id'";
}



if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}


 }
    


  }
} else {
  echo "0 results";
}

ini_set('memory_limit', '2048M');

$conn->close();

 ?>