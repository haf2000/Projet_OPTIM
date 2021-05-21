<?php 

class Chromosome{

    private $MAX_COMBINATION_LENGTH = 10;
    private $heuristic_map =
    array("f" => "FirstFit",
        "n"=> "NextFit",
        "w" => "WorstFit",
        "b"=> "BestFit");
  
  function __construct($capacity, $pattern) 
    {
    $this->capacity = $capacity; 
    $this->fitness = 0;
    $this->num_bins = 0;
    $this->pattern = $pattern;
    }

    public function generate_pattern(){

    }


        return "".join([ array_rand($heuristic_map) for _ in range(random.randrange(Chromosome.MAX_COMBINATION_LENGTH) or 1)])

        for($i=0;$i<;$i++)
}
?>