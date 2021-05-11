<!DOCTYPE html>
<html>
<head>
	<title>test PD</title>
</head>
<body>

</body>
</html>



<?php

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
			$this->heap = new SplMinHeap();
	 		$this->items = array();
     		$this->utilization = 0;		
		}
	  

	 function getName(){return $this->name;}
	 function getCapacity(){return $this->capacity;}
	 function getTotalWeight()
	 	{	$total = 0 ;
	 		if (count($this->items) > 0) 
	 			{	 		 	
			 		for ($p=0; $p<count($this->items); $p++) 
	 		 		{
	 		 			$total = $total + $this->items[$p]->weight;
	 		 		}
	 		 	}
	 		 return $total;
	 	}
	 function getUtilization(){return round(($total / $this->capacity) * 100, 2);}
	 function push($item)
	 	{
	 		$this->heap->insert($item);
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
	function getBins(){return $this->bins;}
	function setBins($bins){$this->bins=$bins;}
	function getTV($capacity,$items)
		{
			$tv = array(array());
				 for ($i=0;$i<count($items);$i++)
					{
							 for ($j=0; $j<$capacity+1; $j++) 
								{		
						  			$tv[$i][$j]=true;
								}
					}
				for ($i=0;$i<count($items);$i++)
					{
					for ($j=0;$j<$capacity+1; $j++) 
							{					
						  		if ($i==0)
						  			 {
						  				if ($j != $items[$i]->weight && $j > 0) {$tv[$i][$j] = false;}
						  			 }

								else
									{
				                    if ($j < $items[$i]->weight) {$tv[$i][$j] =$tv[$i - 1][$j];}
				                    else {$tv[$i][$j] = $tv[$i - 1][$j] || $tv[$i - 1][$j - $items[$i]->getWeight()];}
				                	}
				            }
					}
				return $tv;	
		}
	function pickItems($tv)
	{
		$choix = array();
		$k= (count($tv[0])) - 1;
		$j=0;

		for ($index=0;$index < count($tv[0]);$index++)
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
	function moveItemsToBin($itemIndices, $binIndex)
	{
		for ($i=0;$i<count($itemIndices);$i++)
			{
				array_push($this->bins[$binIndex],$this->items[$i]);
				array_splice($this->items,$i,1);
			}
	}
	function packItems(){
		asort($this->items);
		if(count($this->bins) > 0)
			{	

				$b=0;
				while($this->bins[$b] != 100.00) $b++;
				$capacityRest= $this->bins[$b]->getCapacity - $this->bins[$b]->getTotalWeight;
				$m = $this->getTV($capacityRest,$this->bins[$b]);
				$picked_items = $this->picked_items($m);
				$this->moveItemsToBin($picked_items,$b);
			}

		while(count($this->items) > 0)
			{	
				$m = $this->getTV($this->capacity,$this->items);
				$newBin = new bin(count($this->bins),$this->capacity);
				array_push($this->bins, $newBin);
				$binIndex = count($this->bins) - 1;          
				$pickedItems = $this->pickItems($m);
				$this->moveItemsToBin($pickedItems,$binIndex);
			}
		}

	}


/***********************************************************************/

$packer = new Binpacker(11);
$a= new item('A', 4);
$b= new item('B', 1);
$c= new item('C', 2);
$d= new item('D', 6);
$e= new item('E', 9);
$f= new item('F', 3);
$g= new item('G', 7); 
$h= new item('H', 2); 
$i= new item('I', 5);
$tab = array();
array_push($tab,$a,$b,$c,$d,$e,$f,$g,$h,$i);
$packer->setItems($tab);
$n= $packer->getItems()[0]->getName();

$packer->packItems();

?>