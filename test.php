<?php 


$original = array( 'a', 'b', 'c', 'd', 'e' );
$inserted = array( 'x' ); // not necessarily an array, see manual quote

array_splice( $original, 3, 0, $inserted ); // splice in at position 3
// $original is now a b c x d e
var_dump($original);
echo "<br>-------------------------------------------------------<br>";
$set = array();
if(!in_array(1,$set)){
array_push($set,1);
}
if(!in_array(1,$set)){
array_push($set,1);
}
if(!in_array(2,$set)){
array_push($set,2);
}
if(!in_array(3,$set)){
array_push($set,3);
}

var_dump($set);

 ?>