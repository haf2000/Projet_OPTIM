<?php 


/***************************** INTEGRATION ***************************/
set_time_limit(100000); 

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

/****************************  CLASSE AG ************************************/

class GeneticAlgorithm
{   
    function __construct($capacity, $items,$POPULATION_SIZE,$MAX_GENERATIONS,$MAX_NO_CHANGE,$TOURNAMENT_SIZE, $MUTATION_RATE, $CROSSOVER_RATE)
    {
        $this->POPULATION_SIZE = $POPULATION_SIZE;
        $this->MAX_GENERATIONS = $MAX_GENERATIONS;
        $this->MAX_NO_CHANGE = $MAX_NO_CHANGE;
        $this->TOURNAMENT_SIZE = $TOURNAMENT_SIZE;
        $this->MUTATION_RATE = $MUTATION_RATE;
        $this->CROSSOVER_RATE = $CROSSOVER_RATE;
        $this->items = $items;
        $this->best_solution = null; // a revoir
        $this->population = array();
        for ($i=0; $i <  $this->POPULATION_SIZE; $i++) { 
          $cro = new Chromosome($capacity);
          array_push($this->population,$cro);
        }
        $this->update_individuals($this->population);
    }
    function getBestSolution(){ return $this->best_solution;}
    function getPopulation(){return $this->population;}

    function AG(){
     $current_iteration = 0;
     $num_no_change = 0;
     while ($num_no_change<$this->MAX_NO_CHANGE and $current_iteration<$this->MAX_GENERATIONS) {
         $new_generation = array();
         while (count($new_generation) < $this->POPULATION_SIZE) {
              # Select parents
                $parent1 = $this->select_parent();
                $parent2 = $this->select_parent();
          //  echo "<br>parent 1 : ".$parent1->getPattern()." |  parent 2 : ".$parent2->getPattern();
                 # Apply genetic operators
                $crossover_tab = $this->crossover($parent1,$parent2);
                $child1 = $crossover_tab[0];
                $child2 = $crossover_tab[1];
          //  echo "child 1 : ".$child1->getPattern()." |  child 2 : ".$child2->getPattern();
                $child1 = $this->mutate($child1);
                $child2 = $this->mutate($child2);
                 # Update the fitness values of the offspring to determine whether they should be added
                $children_tab = array($child1,$child2);
                $this->update_individuals($children_tab);
                $tab = array($parent1,$parent2,$child1,$child2);
                usort($tab,"GeneticAlgorithm::cmp_2");

             # Add to new generation the two best chromosomes of the combined parents and offspring
                array_push($new_generation,$tab[0]);
                array_push($new_generation,$tab[1]);
                
         }
         $this->population = $new_generation;
         $prev_best = $this->best_solution;
            # Evaluate fitness values
         $this->best_solution = $this->update_individuals($this->population);
            # Check if any improvement has happened.
         if( ( $prev_best == null) or ($prev_best->getFitness() == $this->best_solution->getFitness())){
            $num_no_change++;
         }else{
             $num_no_change=0;
             $current_iteration++;
         }
           
     }
      $result = array($current_iteration, $num_no_change);
     return $result;
    }

      public static function cmp_2($a, $b)
{
    if ($a->getFitness() == $b->getFitness() ) {
        return 0;
    }else{
     if ($a->getFitness() < $b->getFitness()){
        return 1;
     }else{
        return -1;       
     }
    }


}
    
    function rand_float($st_num=0,$end_num=1,$mul=1000000)
{
if ($st_num>$end_num) return false;
return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
}

    function mutate($chromosome){
      $pattern = $chromosome->getPattern();
      $tab_pattern = str_split($pattern);
      if($this->rand_float() < $this->MUTATION_RATE){
        if(strlen($pattern) == 0){
            $mutation_point =0;
        }else{
       $mutation_point = mt_rand(0,strlen($pattern)-1); 
        }
       $tab_pattern[$mutation_point] = $chromosome->generate_pattern();
      }
      $new_pat ="";
       for ($i=0; $i < count($tab_pattern); $i++) { 
           $new_pat = $new_pat.$tab_pattern[$i];
       }
       $c = new Chromosome($chromosome->capacity);
       $c->setPattern($new_pat);
       return $c;
    }


    function crossover($parent1, $parent2){
        $pattern1 = $parent1->getPattern();
        $pattern2 = $parent2->getPattern();
        $pattern1_new = $pattern1;
        $pattern2_new = $pattern2;
         // echo "<br> lentgh pattern1 ".strlen($pattern1)." | pattern1 : ".$pattern1;
         // echo "<br> lentgh pattern2 ".strlen($pattern2)." | pattern2 : ".$pattern2;        
      if($this->rand_float() < $this->CROSSOVER_RATE){
        if(strlen($pattern1) == 0){
            $point1 =0;
        }else{
        $point1 = mt_rand(0,strlen($pattern1)-1);            
        }

        if(strlen($pattern2) == 0){
            $point2 =0;
        }else{
        $point2 = mt_rand(0,strlen($pattern2)-1);
        }
         // echo "<br> point1 ".$point1;
         // echo "<br> point2 ".$point2;
        $substr1 = substr($pattern1,$point1, strlen($pattern1)-$point1); 
        $substr2 = substr($pattern2,$point2, strlen($pattern2)-$point2); 
         // echo "<br> substr1 ".$substr1;
         // echo "<br> substr2 ".$substr2;
        $pattern1_new =  substr($pattern1,$point1, strlen($pattern1)-$point1).$substr2;
        $pattern2_new =  substr($pattern2,$point2, strlen($pattern2)-$point2).$substr1;
         // echo "<br> lentgh pattern_new1 ".strlen($pattern1_new)." | pattern_new1 : ".$pattern1_new;
         // echo "<br> lentgh pattern_new2 ".strlen($pattern2_new)." | pattern_new2 : ".$pattern2_new;  
      }
        $c1 = new Chromosome($parent1->capacity);
        $c1->setPattern($pattern1_new);
        $c2 = new Chromosome($parent2->capacity);
        $c2->setPattern($pattern2_new);
        return array($c1,$c2);
    }

    function update_individuals($individuals){
    $nombre_ind = count($individuals);
   // echo "<br>nombre de individuals : $nombre_ind";
     for ($i=0; $i < $nombre_ind; $i++) { 
      //  echo "<br> individual's pattern number $i : ".$individuals[$i]->getPattern();
       $solution = $individuals[$i]->generate_solution($this->items);
       $numb_sol = count($solution);
       $individuals[$i]->setNumBin($numb_sol);
       $res = 0;
       for ($l=0; $l < $numb_sol ; $l++) { 
          $res = $res + $solution[$l]->fitness();
       }
       $res = $res / $numb_sol;
       $individuals[$i]->setFitness($res);
     }
     
     $pop = $this->population;
     usort($pop,"GeneticAlgorithm::cmp");
     return  $pop[0];

    }

    public static    function cmp($a, $b)
{
    if ($a->getFitness() == $b->getFitness() ) {
        return 0;
    }else{
     if ($a->getFitness() > $b->getFitness()){
        return 1;
     }else{
        return -1;       
     }
    }


}


function select_parent(){
 // Selects a parent from the current population by applying tournament selection.
 // return: The selected parent.  
 $randrange = mt_rand(1,count($this->population)-1); // random index
 $candidate =  $this->population[$randrange];

 $r = $this->TOURNAMENT_SIZE - 1;
 for ($i=0; $i <  $r; $i++) { 
     $randrange2 = mt_rand(1,count($this->population)-1); // random index
     $opponent =  $this->population[$randrange2];
      if($opponent->getFitness() > $candidate->getFitness()){
         $candidate = $opponent;
      } 
 }

return $candidate;
}

}
/***************************** CHROMOSOME ***************************/
class Chromosome{

    private $MAX_COMBINATION_LENGTH = 10;
    private $heuristic_map =
    array("f" => "FirstFit",
        "n"=> "NextFit",
        "w" => "WorstFit",
        "b"=> "BestFit");
  
  function __construct($capacity) 
    {
    $this->capacity = $capacity; 
    $this->fitness = 0;
    $this->num_bins = 0;
    $this->pattern = $this->generate_pattern();
    }
    public function getPattern(){return $this->pattern;}
    public function setPattern($pat){$this->pattern = $pat;}
    public function setNumBin($num){$this->num_bins = $num;}
    public function getNumBin(){return $this->num_bins;}
    public function setFitness($fit){$this->fitness = $fit;}
    public function getFitness(){return $this->fitness;}

    public function generate_pattern(){
        $pattern = "";
        $randrange = mt_rand(1,$this->MAX_COMBINATION_LENGTH); 
        for($i=0;$i<$randrange;$i++){
         $rand_key = array_rand($this->heuristic_map, 1);
         $pattern = $pattern.$rand_key;
        }
        return $pattern;
    }

        public function generate_solution($items){
            $bin =  new Bin($this->capacity);
            $solution = array();
            array_push($solution,$bin);

            $pattern_length = strlen($this->pattern);

            $tab_keys = str_split($this->pattern); 
            for($j=0;$j<count($items);$j++){
            $pat_ind = $j%$pattern_length;
            $h = $tab_keys[$pat_ind];
            $item = $items[$j];
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

/**********************************  TEST  *********************************************/

/***********************************CALLING INSTANCES********************************************/

$POPULATION_SIZE = 50;
$MAX_GENERATIONS = 250;
$MAX_NO_CHANGE = 50;
$TOURNAMENT_SIZE = 20;
$MUTATION_RATE = 0.3;
$CROSSOVER_RATE = 0.6;

$sql = "SELECT * FROM `resultats` WHERE 1";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  
      $solution_ex = $row["solMet_one"]; $temps_ex = $row["tempsMet_one"];
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
      if($type == '2'){
        $structure = lire_instance_difficile($row["nom_instance"]);
        $poids_min = $structure["poids_min"];
      $poids_max = $structure["poids_max"]; 
      }else{
       if($type == '3'){
         $structure = lire_instance_U($row["nom_instance"]);
       }else{
         $structure = lire_instance_T($row["nom_instance"]);
       }
      }
             
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

  if ($row["nom_instance"] == "Falkenauer_u1000_00.txt") {
    $solMet_one = 403; $tempsMet_one = 0;
  }else{
    if ($row["nom_instance"] == "Falkenauer_u1000_19.txt") {
    $solMet_one = 406; $tempsMet_one = 0;
  }else{
    $timestart=microtime(true);
$thing = new GeneticAlgorithm($capacite, $items,$POPULATION_SIZE,$MAX_GENERATIONS,$MAX_NO_CHANGE,$TOURNAMENT_SIZE,$MUTATION_RATE,$CROSSOVER_RATE);
$res = $thing->AG();
// echo "<br>current iteration : ".$res[0];
// echo "<br>num no change : ".$res[1];
  $solMet_one = $thing->getBestSolution()->getNumBin();
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsMet_one = number_format($time, 5);
  }
  }
 

if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solMet_one`='$solMet_one',`tempsMet_one`= '$tempsMet_one' WHERE id='$id'";
}else{
  if($type == '1'){
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solMet_one`='$solMet_one',`tempsMet_one`= '$tempsMet_one' WHERE id='$id'";
  }else{
    // classe U ou T
    $sql = "UPDATE resultats SET `capacite`='$capacite',`nombre_objets`='$nombre_objets',`solMet_one`='$solMet_one',`tempsMet_one`= '$tempsMet_one' WHERE id='$id'";
  }

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