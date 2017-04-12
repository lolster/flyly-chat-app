<?php
    function build_sorter($key){
        return function($a,$b) use ($key){
            return strnatcmp($a[$key] , $b[$key]);
        };
    }
     $array[0] = array('key_a'=> 'z' , 'key_b'=>'c');
     $array[1] = array('key_a'=> 'x' , 'key_b'=>'b');
     $array[2] = array('key_a'=> 'y' , 'key_b'=>'a');
     echo json_encode($array);
     echo "<br>";
     usort($array, build_sorter("key_b"));
     echo "After sorting : <br>";
     echo json_encode($array);
    //print_r(build_sorter('key_a'));
    
?>