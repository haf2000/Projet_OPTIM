<?php 

/***************************** INTEGRATION ***************************/
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
/***************************** NextFit ***************************/
class NextFit
{
      public static function apply($item, $bins){
        $last = count($bins)-1;
        $b = $bins[$last];
        if(!$b->add_item($item)){
          $b = new Bin($bins[0]->capacity);
          $b->add_item($item);
          array_push($bins,$b);
        }
        return $bins;
      }
}

/***************************** WorstFit ***************************/
class WorstFit
{

     public static function cmp($a, $b)
{
    if ($a->filled_space() == $b->filled_space() ) {
        return 0;
    }else{
     if ($a->filled_space() > $b->filled_space()){
        return 1;
     }else{
        return -1;       
     }
    }


}
      public static function apply($item, $bins){
    $nombre_bins = count($bins);
    $valid_bins = array();
    for ($i=0; $i < $nombre_bins; $i++) { 
        if( $bins[$i]->can_add_item($item) ){
            array_push($valid_bins,$bins[$i]);
        }
    }
     if(count($valid_bins) != 0){
     usort($valid_bins,"WorstFit::cmp");
     $bin = $valid_bins[0];
     $bin->add_item($item);
    }else{
     $bin = new Bin($bins[0]->capacity);
     $bin->add_item($item);
     array_push($bins,$bin);
    }
       
        return $bins;
      }
}
/***************************** BestFit ***************************/
 class BestFit{

public static function cmp($a, $b)
{
    if ($a->filled_space() == $b->filled_space() ) {
        return 0;
    }else{
     if ($a->filled_space() < $b->filled_space()){
        return 1;
     }else{
        return -1;       
     }
    }


}

  public static function apply($item, $bins){
    $nombre_bins = count($bins);
    $valid_bins = array();
    for ($i=0; $i < $nombre_bins; $i++) { 
        if( $bins[$i]->can_add_item($item) ){
            array_push($valid_bins,$bins[$i]);
        }
    }
    if(count($valid_bins) != 0){
     usort($valid_bins,"BestFit::cmp");
     $bin = $valid_bins[0];
     $bin->add_item($item);
    }else{
     $bin = new Bin($bins[0]->capacity);
     $bin->add_item($item);
     array_push($bins,$bin);
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

/****************************  CLASSE REMOVE ************************************/
/**
 * 
 */
class Remove 
{
	/*Removes one or more of the items from the items list. Guarantees that there will always be at least one item left in the list of items.*/
	public static function apply($items, $choices){
	   $items_arr = str_split($items);

		if(count($items_arr) == 0){
		$num_removals = 0;
		}else{
		$num_removals = mt_rand(0,count($items_arr)-1);	
		}
		for ($i=0; $i < $num_removals; $i++) { 
			if(count($items_arr) == 0){
		    $to_remove = 0;
		 	}else{
			$to_remove = mt_rand(0,count($items_arr)-1);	
			}
			array_splice($items_arr,$to_remove);
		}
	  $new_pat ="";
       for ($i=0; $i < count($items_arr); $i++) { 
           $new_pat = $new_pat.$items_arr[$i];
       }
      return $new_pat;
	}
	
}

/****************************  CLASSE ADD ************************************/

class Add 
{
	/*Adds one or more randomly picked items from the choices list to the list of items.
        :param items: The items to which the operator should be applied.
        :param choices: Items that the operator can inject into the items if necessary.
        :return: The list of items after the operator was applied.*/
		public static function apply($items, $choices){
		$items_arr = str_split($items);
		$l = count($items_arr);
		$num_inserts = mt_rand(0,$l);
		for ($i=0; $i < $num_inserts; $i++) { 
			if(count($items_arr) == 0){
				$to_insert =0;
			}else{
				$to_insert = mt_rand(0,count($items_arr)-1);					
			}
			//pick a random choice of choices 
			if(count($choices) != 0){
			$rand_index_choice = mt_rand(0,count($choices)-1);
			$choice = $choices[$rand_index_choice];
			$choices_arr = array($choice);
			array_splice( $items_arr, $to_insert, 0, $choices_arr); // splice in at position 3
			}
		}
		$new_pat ="";
       for ($i=0; $i < count($items_arr); $i++) { 
           $new_pat = $new_pat.$items_arr[$i];
       }
		return $new_pat;
		}
}
 

/****************************  CLASSE CHANGE ************************************/

       class Change 
       {
       	/*Changes one or more of the items in the item list to a randomly picked item in the choices list.
        :param items: The items to which the operator should be applied.
        :param choices: Items that the operator can inject into the items if necessary.
        :return: The list of items after the operator was applied.*/
        		public static function apply($items, $choices){
        				   $items_arr = str_split($items);
        			$l = count($items_arr);
					$num_changes = mt_rand(0,$l);
					for ($i=0; $i < $num_changes ; $i++) { 
						if(count($items_arr) == 0){
							$to_change  =0;
						}else{
							$to_change = mt_rand(0,count($items_arr)-1);					
						}
						if(count($choices) != 0){
						$rand_index_choice = mt_rand(0,count($choices)-1);
						$choice = $choices[$rand_index_choice];
						$items_arr[$to_change] =  $choice;
						}
					}
					$new_pat ="";
       for ($i=0; $i < count($items_arr); $i++) { 
           $new_pat = $new_pat.$items_arr[$i];
       }
		return $new_pat;
				}
       }
       
/****************************  CLASSE SWAP ************************************/

class Swap
{
		/*Swaps one or more of the items with another one in the item list.
        :param items: The items to which the operator should be applied.
        :param choices: Items that the operator can inject into the items if necessary.
        :return: The list of items after the operator was applied.*/
                		public static function apply($items, $choices){ 			       
                			$items_arr = str_split($items);
        			$l = count($items_arr);
					$num_swaps = mt_rand(0,$l);
					for ($i=0; $i < $num_swaps; $i++) { 
						// id item 1
						if(count($items_arr) == 0){
							$idx1  =0;
						}else{
							$idx1 = mt_rand(0,count($items_arr)-1);					
						}
						// id item 2
						if(count($items_arr) == 0){
							$idx2  =0;
						}else{
							$idx2 = mt_rand(0,count($items_arr)-1);					
						}
						// swap em
						$items_arr[$idx1] = $items_arr[$idx2];
						$items_arr[$idx2] = $items_arr[$idx1];
					}
					$new_pat ="";
       for ($i=0; $i < count($items_arr); $i++) { 
           $new_pat = $new_pat.$items_arr[$i];
       }
		return $new_pat;
				}
}

/****************************  CLASSE TEBU-SEARCH ************************************/
class TabuSearch 
{
    private $heuristic_map =
    array("f" => "FirstFit",
        "n"=> "NextFit",
        "w" => "WorstFit",
        "b"=> "BestFit");

    private $movers =
    array("a" => "Add",
        "r"=> "Remove",
        "c" => "Change",
        "s"=> "Swap");
	
	function __construct($capacity, $items, $MAX_COMBINATION_LENGTH, $MAX_ITERATIONS, $MAX_NO_CHANGE)
	{
		 
        // Creates an instance that can run the tabu search algorithm.
        // :param capacity: The capacity of a bin.
        // :param items: The items that have to be packed in bins.
        
        $this->MAX_COMBINATION_LENGTH = $MAX_COMBINATION_LENGTH;
        $this->MAX_ITERATIONS = $MAX_ITERATIONS;
        $this->MAX_NO_CHANGE = $MAX_NO_CHANGE;
        $this->bin_capacity = $capacity;
        $this->items = $items;
        $this->fitness = 0;
        $b = new Bin($capacity);
        $this->bins = array($b);
        $this->tabu_list = array(); // considered as SET
	}

	public function generate_solution($pattern){
		/*
		Generates a candidate solution based on the pattern given.
        :param pattern: A pattern indicating the order in which heuristics need to be applied to get the solution.
        :return: A list of bins to serve as a solution.
		*/
		    $bin =  new Bin($this->bin_capacity);
            $solution = array();
            array_push($solution,$bin);

            $pattern_length = strlen($pattern);

            $tab_keys = str_split($pattern); 
              for($j=0;$j<count($this->items);$j++){
            $pat_ind = $j%$pattern_length;
            $h = $tab_keys[$pat_ind];
            $item = $this->items[$j];
            if($h == 'f'){ //first fit
               $solution = FirstFit::apply($item,$solution); 
            }else{
                if($h == 'n'){ // next fit
               $solution = NextFit::apply($item,$solution); 
                }else{
                    if($h == 'b'){ // best fit
               $solution = BestFit::apply($item,$solution); 
                    }else{ // worst fit
               $solution = WorstFit::apply($item,$solution); 
                    }
                }

            } 
            


            }
        
        return $solution;
	}



	public function apply_move_operator($pattern){
		/* Applies a random move operator to the given pattern.
        :param pattern: The pattern to apply the move operator to.
        :return: The pattern after the move operator has been applied.
        */
        $liste_heuris = array_keys($this->heuristic_map);
        $h = array_rand($this->movers);
        if($h == 'a'){ 
               $solution = Add::apply($pattern,$liste_heuris); 
            }else{
                if($h == 'r'){
               $solution = Remove::apply($pattern,$liste_heuris); 
                }else{
                    if($h == 'c'){
               $solution = Change::apply($pattern,$liste_heuris); 
                    }else{ 
               $solution = Swap::apply($pattern,$liste_heuris); 
                    }
                }

            } 
          return $solution;
	}

    public function generate_pattern(){
        $pattern = "";
        $randrange = mt_rand(1,$this->MAX_COMBINATION_LENGTH); 
        for($i=0;$i<$randrange;$i++){
         $rand_key = array_rand($this->heuristic_map, 1);
         $pattern = $pattern.$rand_key;
        }
        return $pattern;
    }
	public function rt(){
		/** Runs the tabu search algorithm and returns the results at the end of the process.
        :return: (num_iterations, num_no_changes, chosen_combination)**/
	    $combination = $this->generate_pattern();
	    $this->bins = $this->generate_solution($combination);

	    $numb_bins = count($this->bins);
	    $res = 0;
        for ($l=0; $l < $numb_bins ; $l++) { 
        $b = $this->bins[$l];
          $res = $res + $b->fitness();
        }
        $res = $res / $numb_bins;

        if(!in_array($combination,$this->tabu_list)){
        	array_push($this->tabu_list, $combination);
        }
        $current_iteration =0;
        $num_no_change = 0;

        while ( ($num_no_change < $this->MAX_NO_CHANGE) and ($current_iteration < $this->MAX_ITERATIONS)) {
        	$new_combination = $this->apply_move_operator($combination);
        	while (strlen($new_combination) > $this->MAX_COMBINATION_LENGTH) {
        		$new_combination = $this->apply_move_operator($combination);
        	}
        	if(!in_array($combination,$this->tabu_list)){
        		array_push($this->tabu_list,$new_combination);
        		$solution = $this->generate_solution($new_combination);

        		$fitness = 0;
        		for ($b=0; $b < count($solution) ; $b++) { 
        			$fitness = $fitness + $solution[$p]->fitness();
        		}
        		$fitness = $fitness / count($solution);
        		if( $fitness > $this->fitness){
        			$this->bins = $solution;
        			$this->fitness = $fitness;
        			$num_no_change =0;
        			$combination = $new_combination;

        		}
        	}
        	$current_iteration +=1;
        	$num_no_change +=1;
        }

    $results = array();
    array_push($results, $current_iteration);
    array_push($results, $num_no_change);
    array_push($results, $combination);
    return $results;

	}


}
/*********************************   INITIALISATION   ************************************/

$MAX_COMBINATION_LENGTH=10;
$MAX_ITERATIONS=5000;
$MAX_NO_CHANGE = 1000;

/*********************************   INTEGRATION   ************************************/

$sql = "SELECT * FROM `resultats` WHERE 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  
      $solution_ex = $row["solMet_three"]; $temps_ex = $row["tempsMet_three"];
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

  // Lancer AG
 // créer table des items 
  $items = array();
  for ($i=0; $i < $nombre_objets; $i++) { 
      $item = new item($liste_obj[$i]);
      array_push($items,$item);
  }

$timestart=microtime(true);
$thing = new TabuSearch($capacite, $items,$MAX_COMBINATION_LENGTH,$MAX_ITERATIONS,$MAX_NO_CHANGE);
$res = $thing->rt();
$solMet_three = count($thing->bins);
$timeend=microtime(true);
$time=$timeend-$timestart;
$tempsMet_three = number_format($time, 5);


if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solMet_three`='$solMet_three',`tempsMet_three`= '$tempsMet_three' WHERE id='$id'";
}else{
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solMet_three`='$solMet_three',`tempsMet_three`= '$tempsMet_three' WHERE id='$id'";
}



if ($conn->query($sql) === TRUE) {
  echo "<br>INSTANCE TRAITEE !! ";
} else {
  echo "Error updating record: " . $conn->error;
}


}
    
  }
} else {
  echo "0 results";
}

$conn->close();



?>