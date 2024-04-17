<?php
include_once "../Properties.php";
$arr = Properties::getSeachTerms();
$counties = ['Berkshire', 'Berlin', 'Concord', 'Delaware', 'Genoa', 'Harlem', 'Kingston', 'Lewis Center', 'Liberty', 'Marlboro', 'Orange', 'Oxford', 'Porter', 'Scioto', 'Thompson', 'Trenton', 'Troy', 'Washington'];
$zipcodes = ['43011', '43015', '43021', '43035', '43074', '43103', '43235', '43463', '44024', '44077', '44601', '45003', '45044', '45342'];
$arr = array_map(function ($item) {
    return ["value"=>$item, "type"=>"address"];
}, $arr);

// Add counties to the array
foreach ($counties as $item) {
    $arr[] = ["value"=>$item, "type"=>"county"];
}

// Add zipcodes to the array
foreach ($zipcodes as $item) {
    $arr[] = ["value"=>$item, "type"=>"zipcode"];
}

header('Content-Type: application/json; charset=utf-8');
print json_encode($arr)
?>