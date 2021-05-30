<?php

set_time_limit(100000);
ini_set('memory_limit', -1);

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

/* 	définition de la classe bin*/

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
	 	{	$total = 0 ;
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
			{	 ksort($this->items);
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
$w1= array(100,97,92,91,89,88,83,82,82,82,78,77,77,77,73,72,68,67,66,65,64,62,60,60,57,53,50,48,46,42,40,40,38,37,37,31,30,29,28,21,20,20,20,20,18,18,15,15,11,1);

$w1= array(100,100,100,99,99,98,97,96,96,96,96,95,94,94,93,92,92,92,91,91,91,90,90,89,88,87,87,87,87,87,86,86,86,85,84,83,83,83,83,82,82,81,81,81,81,80,80,79,79,79,78,78,78,78,78,76,76,76,76,76,76,75,74,74,74,73,73,72,71,69,69,69,67,66,65,64,63,63,63,62,61,61,60,59,57,57,56,56,56,55,55,54,54,54,54,54,53,53,52,52,51,50,48,48,48,48,47,46,46,45,45,45,43,42,40,40,40,39,39,39,39,38,38,37,37,37,36,35,34,32,31,31,30,30,29,28,27,27,26,25,24,24,24,24,24,22,22,21,21,21,21,20,19,19,18,18,18,18,18,17,16,16,16,15,15,14,14,13,13,12,12,12,12,11,11,11,11,10,9,9,8,7,6,6,6,6,6,6,5,5,5,4,4,3,3,3,3,2,1,1);
$w1= array(131,131,128,127,127,126,124,123,123,122,120,119,119,115,113,113,112,112,112,111,110,109,109,108,105,105,103,102,102,102,102,101,99,99,99,97,97,97,96,96,96,94,94,94,94,93,92,92,91,90);
$w1 = array(87,83,79,67,54,52,49,45,43,42,34,30,28,25,22,19,16,9,7,2);

// $w1 = array();
//$packer = new Binpacker(1000); // capacité 
$packer = new Binpacker(100); // capacité 


$packer->setItems($w1);
$packer->packItems();

#afficher le contenu des bins + poid total
$sum=0;

for($i=0;$i<count($packer->bins);$i++){
		echo $packer->bins[$i]->getTotalWeight();
		$sum=$sum+ count( $packer->bins[$i]->getItems());
		echo '<br>';
		print_r($packer->bins[$i]->getItems());
		echo '<br>';
}

#afficher l solution optimale
echo '<br>';echo 'La solution optimale : ';
echo count($packer->bins);
#afficher temps d'execution 

$timeend=microtime(true);
$time=$timeend-$timestart;
echo '<br>';
echo 'le temps d execution est : '.$time;