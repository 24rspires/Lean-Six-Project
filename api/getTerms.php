<?php
include_once "../Properties.php";
$arr = Properties::getSeachTerms();
$prop = ['Berkshire', 'Berlin', 'Concord', 'Delaware', 'Genoa', 'Harlem', 'Kingston', 'Lewis Center', 'Liberty', 'Marlboro', 'Orange', 'Oxford', 'Porter', 'Scioto', 'Thompson', 'Trenton', 'Troy', 'Washington'];

$arr = array_map(function ($item) {
    return ["value"=>$item, "type"=>"address"];
}, $arr);

foreach ($prop as $item) {
    $arr[] = ["value"=>$item, "type"=>"county"];
}
header('Content-Type: application/json; charset=utf-8');
print json_encode($arr)
?>