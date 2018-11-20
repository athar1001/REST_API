<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/menu.php';
include_once 'scraping.php'; 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$menu = new menu($db);
$scraping = new scraping($db);
// get keywords

 
// query menu
$stmt = $menu->update();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
	
    echo(json_encode("Today Menu Record Already Updated (Update once in a day).....!"));
	
}
 
else{
	$stmtdel = $scraping->delete();
   $stmtupd = $scraping->getdata();
    echo json_encode("Record Updated");
}
?>