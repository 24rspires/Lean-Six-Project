<?php
include_once "../Properties.php";
$arr = Properties::getSeachTerms();
header('Content-Type: application/json; charset=utf-8');
echo json_encode($arr)
?>