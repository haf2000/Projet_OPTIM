<?php 


class MyClass {

    private $myArray = array();
    function pushSomethingToArray($var) {
        array_push($this->myArray, $var);
    }
    function getArray() {
        return $this->myArray;
    }

}

//push some values to the myArray of Mainclass
$myObj = new MyClass();
$myObj->pushSomethingToArray('blue');
$myObj->pushSomethingToArray('orange');
$myObjClone = clone $myObj;
$myObj->pushSomethingToArray('pink');

//testing
print_r($myObj->getArray());     //Array([0] => blue,[1] => orange,[2] => pink)
print_r($myObjClone->getArray());//Array([0] => blue,[1] => orange)
//so array  cloned

 ?>