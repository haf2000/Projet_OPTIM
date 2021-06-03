<?php 

set_time_limit(1000000); 
ini_set('memory_limit', '-1');

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
  
  $solution_ex = $row["solBB"]; $temps_ex = $row["tempsBB"];
  if($solution_ex == 0 and $temps_ex == 0){
     
  $id = $row["id"];
  $type = $row["type_instance"];
  $optimale = $row["solution_optimale"];
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
 if($optimale != 0){
    $tempsBB = 0; $solBB  = $optimale;
 }else{
  $tempsBB = 0; $solBB  = 0;
  $timestart=microtime(true);
  var_dump($liste_obj);
 $solBB  = branch_bound($liste_obj,$nombre_objets,$capacite);
  $timeend=microtime(true);
  $time=$timeend-$timestart;
  $tempsBB = number_format($time, 5);
 }
 




if($type == '0' or $type == '2'){
$sql = "UPDATE resultats SET `poids_min`='$poids_min',`poids_max`='$poids_max',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solBB`='$solBB',`solution_optimale`='$solBB',`tempsBB`= '$tempsBB' WHERE id='$id'";
}else{
  if($type == '1'){
$sql = "UPDATE resultats SET `poids_moyen`='$poids_moyen',`capacite`='$capacite',`nombre_objets`='$nombre_objets',`solBB`='$solBB',`solution_optimale`='$solBB',`tempsBB`= '$tempsBB' WHERE id='$id'";
  }else{
    // classe U ou T
    $sql = "UPDATE resultats SET `capacite`='$capacite',`nombre_objets`='$nombre_objets',`solBB`='$solBB',`solution_optimale`='$solBB',`tempsBB`= '$tempsBB' WHERE id='$id'";
  }

}

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully<br>";
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