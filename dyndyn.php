<?php 


 
set_time_limit(1000); 
ini_set('memory_limit', '-1');



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
  $packer = new Binpacker($capacite); 
  $tab = array();
  $nomm = "Objet";
  for ($i=0; $i < $nombre_objets ; $i++) { 
    
  $a= new item($nomm, $liste_obj[$i]);
  array_push($tab,$a);
   
  }

  $timestart=microtime(true);
  $packer->setItems($tab);
  $packer->packItems();
  $solDP = count($packer->bins); // nombre de bins
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsDP = number_format($time, 5);


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