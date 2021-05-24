<?php 

set_time_limit(1000); 

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

/***************************** FirstFit ***************************/
class FirstFit{
  public static function apply($item, $bins){
    $nombre_bins = count($bins);
    for ($i=0; $i < $nombre_bins ; $i++) { 
    $b = $bins[$i]->can_add_item($item);
    if($b){
        $bins[$i]->add_item($item); 
        break;
    }
    }
    if(!$b){
     $bin_new = new Bin($bins[0]->capacity); 
     $bin_new->add_item($item);
     array_push($bins,$bin_new);
    }

    return $bins;
  }

}

/****************************  CLASSE ITEM ************************************/

class item
{
  function __construct($weight) 
    {
      $this->weight = $weight;
    }
  function getWeight(){return $this->weight;}
  function Inf($objet){return $this->weight < $objet->weight ;}
  function Egal($objet){return $this->weight == $objet->weight ;}
}
/****************************  CLASSE BIN ************************************/

class Bin{

   function __construct($capacity){
        $this->capacity = $capacity; 
        $this->items = array();
   }

  function getItems(){
  	return $this->items;
  }

 function can_add_item($new_item){
return ($new_item->weight <= $this->open_space());
 }

function open_space(){
    $res = $this->capacity - $this->filled_space();
    return $res;
}

function filled_space(){
    $total = 0 ;
      if (count($this->items) > 0) 
        {       
          for ($p=0; $p<count($this->items); $p++) 
          {
            $total = $total + $this->items[$p]->weight;
          }
        }
       return $total;
}

function fitness(){

    $fit = ($this->filled_space()/$this->capacity);
    $res = pow($fit,2);
    return $res;
}


function add_item($new_item){
 if($this->can_add_item($new_item)){
    array_push($this->items,$new_item);
    return true;
 }else{
    return false;
 }
}

}

/****************************  CLASSE SA ************************************/
class SA
{
	function __construct($alpha,$capacity, $items,$t_init,$t_target,$iter_nb)
	{
		$this->alpha = $alpha;
        $this->items = $items;
        $this->capacity = $capacity;
        $b = new Bin($capacity);
        $this->bins = array($b);
        $this->t_init = $t_init;
        $this->t_target = $t_target;
        $this->iter_nb = $iter_nb;
	}

function get_neighbour_01(){
   // move a random element from a random bin and to another random bin 
 // $neighbour = clone $this->bins;
  $neighbour =  $this->bins;
	$b_index = mt_rand(0,count($neighbour)-1);
	$bin_to_remove_from = $neighbour[$b_index];
	$items_of_bin_to_remove_from = $bin_to_remove_from->getItems();
  $ll = count($items_of_bin_to_remove_from)-1;
	$i_index = mt_rand(0,$ll);
	$item_to_move = $items_of_bin_to_remove_from [$i_index];
  $itt = $bin_to_remove_from->getItems();
	array_splice($itt, $i_index);
  $bin_to_remove_from->items = $itt;
	$neighbour[$b_index] = $bin_to_remove_from;
	$cont = true;
	while ($cont){
		$bin = $neighbour[mt_rand(0,count($neighbour)-1)];
		if( $bin->can_add_item($item_to_move)){
			$bin->add_item($item_to_move);
			$cont = false;
			break;
		}
	}
	if( count($bin_to_remove_from->getItems()) == 0 ){
        array_splice($neighbour,$b_index);
	}
 return $neighbour;

}


function get_neighbour_11(){
  // swap two random elements from two random bins
		// $neighbour = clone $this->bins;
    $neighbour =  $this->bins;
		$cont = true;
		while ($cont) {
			$b_index1 = mt_rand(0,count($this->bins)-1);
			$b_index2 = mt_rand(0,count($this->bins)-1);
			$bin1 = $neighbour[$b_index1];
			$bin2 = $neighbour[$b_index2];
			$i_index1 = mt_rand(0,count($bin1->getItems())-1);
			$i_index2 = mt_rand(0,count($bin2->getItems())-1);
			$items1 = $bin1->getItems();
			$items2 = $bin2->getItems();
			$item1 = $items1[$i_index1];
			$item2 = $items2[$i_index2];
			if(  ( ($bin1->filled_space() - $item1->getWeight() + $item2->getWeight()) <= $this->capacity ) and (( $bin2->filled_space() - $item2->getWeight() + $item1->getWeight()  ) <= $this->capacity ) ){
				$cont = false;
				break;
			}

		}
		$bin1->items[$i_index1] = $item2;
		$bin2->items[$i_index2] = $item1;
		$neighbour[$b_index1] = $bin1;
		$neighbour[$b_index1] = $bin2;
		return $neighbour;
}

function objective_function(){
	$S = 0;
	for ($i=0; $i < count($this->bins); $i++) { 
		$bin = $this->bins[$i];
		$ss = 0;
		$items = $bin->getItems();
		for ($j=0; $j < count($items) ; $j++) { 
			$ss = $ss + $items[$j]->getWeight();
		}
		$S = ($S + $ss**2) / $this->capacity;
	}
	return $S;
}


 function rs(){
   // Initial solution generated with first fit method
  for ($j=0; $j < count($this->items); $j++) { 
  	$item = $this->items[$j];
  	$this->bins = FirstFit::apply($item,$this->bins);
  }
   // Initialize temperature
  $t = $this->t_init;
   // Average to temprature to separate 
   $t_average = ($this->t_init + $this->t_target) / 2;
   // iterate
   while ($t > $this->t_target) {
   	for ($i=0; $i < $this->iter_nb; $i++) { 
   		if($t > $t_average){
   			$neighbour = $this->get_neighbour_01();
   		}else{
   			$neighbour = $this->get_neighbour_11();
   		}
  $delta = $this->objective_function($neighbour) - $this->objective_function($this->bins);
  		if($delta > 0){
        // $this->bins = clone $neighbour;
        $this->bins =  $neighbour;
  		}else{
  			$u = $this->rand_float();
  			if($u < exp($delta/$t)){
          // $this->bins = clone $neighbour; 
          $this->bins =  $neighbour; 
  			}
  		}
  	$t = $this->alpha * $t;

   	}
   }

 }

     function rand_float($st_num=0,$end_num=1,$mul=1000000)
{
if ($st_num>$end_num) return false;
return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
}

function run_for_hrh($bins){
 //  $this->bins = clone $bins;
   $this->bins = $bins;
    // Initialize temperature
    $t = $this->t_init;
   // Average to temprature to separate 
   $t_average = ($this->t_init + $this->t_target) / 2;
   // iterate
   while ($t > $this->t_target) {
    for ($i=0; $i < $this->iter_nb; $i++) { 
      if($t > $t_average){
        $neighbour = $this->get_neighbour_01();
      }else{
        $neighbour = $this->get_neighbour_11();
      }
  $delta = $this->objective_function($neighbour) - $this->objective_function($this->bins);
      if($delta > 0){
        // $this->bins = clone $neighbour;
        $this->bins =  $neighbour;
      }else{
        $u = $this->rand_float();
        if($u < exp($delta/$t)){
          // $this->bins = clone $neighbour; 
          $this->bins =  $neighbour; 
        }
      }
    $t = $this->alpha * $t;

    }

   }
   
}
       
}
/************************************************************************************/
$sql = "SELECT * FROM `resultats` WHERE 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  
      $solution_ex = $row["solMet_two"]; $temps_ex = $row["tempsMet_two"];

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

  // Lancer RS
 // créer table des items 
  $items = array();
  for ($i=0; $i < $nombre_objets; $i++) { 
      $item = new item($liste_obj[$i]);
      array_push($items,$item);
  }

 $timestart=microtime(true);
 $sa = new SA(0.7,$capacite,$items,500,10,8);
 $sa->rs();
  $solMet_two = count($sa->bins);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsMet_two = number_format($time, 5);


if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solMet_two`='$solMet_two',`tempsMet_two`= '$tempsMet_two' WHERE id='$id'";
}else{
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solMet_two`='$solMet_two',`tempsMet_two`= '$tempsMet_two' WHERE id='$id'";
}



if ($conn->query($sql) === TRUE) {
  echo "<br>INSTANCE TRAITEE !! ";
} else {
  echo "Error updating record: " . $conn->error;
}



    
  }
} else {
  echo "0 results";
}

$conn->close();



?>