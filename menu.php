<?php
class menu{
 
    // database connection and table name
  
    private $table_name = "menu_tbl";
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read products
function read(){
 $json="";
    // select all query
    $query = "SELECT distinct(restaurant_name),menu_item,item_dec,item_price,last_update,address,phone_no FROM " . $this->table_name . " ";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
	$num = $stmt->rowCount();
	if($num>0){
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
       
      $data[] = $row;
   }
  
 
 $json=(json_encode($data));
	
}
 
else{
    $json=json_encode("No Record Found");

}	
	return $json;
   
}
// search products
function search($keywords){
  $json="";
    // select all query
    $query = "SELECT
                 restaurant_name,menu_item,item_dec,item_price,last_update,address,phone_no
            FROM
                " . $this->table_name . " 
            WHERE
                menu_item LIKE ? or item_dec LIKE ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $keywords = "%{$keywords}%";
 
    // bind
    $stmt->bindParam(1, $keywords);
 $stmt->bindParam(2, $keywords);
    // execute query
    $stmt->execute();
 
	$num = $stmt->rowCount();
	if($num>0){
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
       
      $data[] = $row;
   }
  
 
 $json=(json_encode($data));
	
}
 
else{
   $json=json_encode("No Record Found");

}
	
	return $json;
  
}
	
	
function update(){
 $cuurentdatee=date("m/d/Y");
    // select all query
    $query = "SELECT
                 restaurant_name,menu_item,item_dec,item_price,last_update,address,phone_no
            FROM
                " . $this->table_name . " 
            WHERE
                last_update='$cuurentdatee'";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
     // execute query
    $stmt->execute();
 
    return $stmt;
}
	
}
?>