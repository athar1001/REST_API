<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/menu.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$menu = new menu($db);
 
// query menu
$stmt = $menu->read();

 
// check if not null record found
if($stmt!="No Record Found"){
 
echo($stmt);
} 
else{
    echo ($stmt);
}
?>