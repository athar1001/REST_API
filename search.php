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
 
// get keywords
$keywords=isset($_GET["s"]) ? $_GET["s"] : "";

// query menu
$stmt = $menu->search($keywords);

 
if($stmt!="No Record Found"){ 
 
    echo($stmt);
}
 
else{
    echo ($stmt);
}
?>