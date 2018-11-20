<?php

class scraping{
   
 

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	function delete(){
 
    // select all query
    $query = "delete from menu_tbl";
 
    // prepare query statement
    $stmtd = $this->conn->prepare($query);
 
    // execute query
    $stmtd->execute();
	
	
	}
	
function getdata()
  {
	
$hotel=array("Andria Leipzig","Kunst Café Antik","ZamZam Halal");
$url = array("www.andria-leipzig.de/en","https://www.cafe-dresden.de/speisekarte.html","http://www.zamzam-berlin.de/");
$preg=array("<div class=\"col-xs-8\">
 <h6 class=\"food-title\">(.*?)<\/h6>
 <p class=\"food-description\">(.*?)<\/p>
 <\/div>
 <div class=\"col-xs-4\">
 <h6 class=\"food-price\">(.*?)<\/h6>
 <\/div>","<div class=\"pro_menu_price\">(.*?)<\/div>\n\s+<h5>(.*?)<\/h5>\n\s+<div class=\"menu_content_pro\">\n\s+<p>(.*?)<\/p>\n\s+<\/div>","<span class=\"menu_title\">(.*?)<\/span>\n\s+<span class=\"menu_dots\"><\/span>\n\s+<span class=\"menu_price\">(.*?)<\/span>\n\s+<\/h5>\n\s+<div class=\"post_detail menu_excerpt\">(.*?)<\/div>");
	 
$contactdetails=array("<div>(.*?)<\/div>\n\s<div><\/div>\n\s<div><i class=\"fa fa-envelope-o\"><\/i>(.*?)<\/div> <div><i class=\"fa fa-phone\"><\/i>(.*?)<\/div> <\/div>","<p>(.*?)<br>(.*?)<br>(.*?)<br>(.*?) <\/p>\n\s+<span style=\"font-size:20px\"><div <li><a href=\"tel:03514965217\"><\/i>Telefon: (.*?)<\/a>","Adresse:(.*?)<br \/>\nÖffnungszeiten: 12:00–00:00<\/p>\n<p>Telefon: (.*?)<\/div>");


for($j=0;$j<count($url);$j++)
{
$res_name=$hotel[$j];	
$curl=curl_init();
curl_setopt($curl, CURLOPT_URL,$url[$j]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result=curl_exec($curl);
preg_match_all('!'.$contactdetails[$j].'!',$result,$conmatch);

$address="";
$contactno="";
if($res_name=="Andria Leipzig")
{
$detail['addressl1']=$conmatch[1];
$address=addslashes(($detail['addressl1'][0]));
$detail['contactno']=$conmatch[3];
$contactno=addslashes(($detail['contactno'][0]));
}
else if($res_name=="Kunst Café Antik")
{
$detail['addressl1']=$conmatch[1];
$detail['addressl2']=$conmatch[2];
$detail['addressl3']=$conmatch[3];
$detail['addressl4']=$conmatch[4];
$address=addslashes(($detail['addressl1'][0]))." ".addslashes(($detail['addressl2'][0]))." ".addslashes(($detail['addressl3'][0]))." ".addslashes(($detail['addressl4'][0]));
$detail['contactno']=$conmatch[2];
$contactno=addslashes(($detail['contactno'][0]));	
}
else
{
$detail['addressl1']=$conmatch[1];
$address=addslashes(($detail['addressl1'][0]));
$detail['contactno']=$conmatch[2];
$contactno=addslashes(($detail['contactno'][0]));	
}
//}



preg_match_all('!'.$preg[$j].'!',$result,$match);

$cuurentdatee=date("m/d/Y");

if($res_name=="Kunst Café Antik")
{
$menu['name']=$match[2];
$menu['dec']=$match[3];
$menu['prz']=$match[1];
}
else if($res_name=="ZamZam Halal")
{
$menu['name']=$match[1];
$menu['dec']=$match[3];
$menu['prz']=$match[2];
}
else
{
$menu['name']=$match[1];
$menu['dec']=$match[2];
$menu['prz']=$match[3];
}
for($i=0;$i<count($menu['name']);$i++)
{
//$sql = "INSERT INTO menu_tbl(restaurant_name,menu_item,item_dec,item_price,last_update) VALUES ('$res_name','$iname','$ides','$iprz','$cuurentdatee')";
$iname=addslashes(($menu['name'][$i]));
$ides=addslashes(($menu['dec'][$i]));
$iprz=addslashes(($menu['prz'][$i]));
$sql = "INSERT INTO menu_tbl(restaurant_name,menu_item,item_dec,item_price,last_update,address,phone_no) VALUES ('$res_name','$iname','$ides','$iprz','$cuurentdatee','$address','$contactno')";
  // prepare query statement
    $stmtup = $this->conn->prepare($sql);
     // execute query
    $stmtup->execute();
}
 
}

	}
		
}


?>