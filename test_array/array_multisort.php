<?php
$array[] = array("age"=>20,"name"=>"li");
$array[] = array("age"=>21,"name"=>"ai");
$array[] = array("age"=>20,"name"=>"ci");
$array[] = array("age"=>22,"name"=>"di");
 
foreach ($array as $key=>$value){
 $age[$key] = $value['age'];
 $name[$key] = $value['name'];
}
 
array_multisort($age,SORT_NUMERIC,SORT_DESC,$name,SORT_STRING,SORT_ASC,$array);
print_r($array);

