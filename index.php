
<!DOCTYPE html><html lang='en' class=''>
<head>
<script src='js/prefixfree.min.js'></script>
<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
<link rel='stylesheet prefetch' href='css/index.css'>

         <?php
		 
		 $lastupdate='';
				 $api_url='';	 
	if(isset($_POST["search_txt"]))
{
	
 $text = $_POST["search_txt"];
$text = str_replace(" ","%20", $text);

  $api_url = "http://localhost/project/menu/search.php?s=".$text;

}
else
{
	
$api_url = "http://localhost/project/menu/read.php";
	
}
if(isset($_POST["update"]))
{

$updateURL = curl_init("http://localhost/project/menu/update.php");
curl_setopt($updateURL, CURLOPT_RETURNTRANSFER, true);
$updateresponse = curl_exec($updateURL);
$updateresult = json_decode($updateresponse);
// comments

echo "<script>alert('$updateresult');</script>";
   

  
}
?>
</head><body>
<div class="container">
    <div class="well well-sm">

<div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
                
            
                  
        
        
        </div>
        <div style="text-align:right" id="p1">  </div>
         <form method="post" action="index.php"> 
            
         <input type="submit" value="Update Record" class="button button1" name="update"/> 
         
        <input type="submit" value="Show All Record" class="button button1" name="readall"/>
          
        </form>
  <center>
         <form id="searchForm" method="post" action="index.php">
		<fieldset>        
           	<input name="search_txt" id="s" type="text" placeholder="Dish/Ingredient" autofocus required/>            
            <input type="submit" value="Submit" id="submitButton" />
             </fieldset>
    </form>
        
        </center>
       
        
    </div>
     <div id="products" class="row list-group">
       
                    
<?php

$client = curl_init($api_url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);
$result = json_decode($response);
$output = '';

if($result!="No Record Found")
{
	
	
 foreach($result as $row)
 {$lastupdate=$row->last_update;


	
	 
    echo "  		  <div class='item col-xs-4 col-lg-4'>
            <div class='thumbnail'>
                
                <div class='caption'>
                    <h4 class='group inner list-group-item-heading'>".$row->restaurant_name. " Restaurant<br><br>Dish : ".$row->menu_item."</h4>
                    <p class='group inner list-group-item-text'>
                       ".$row->item_dec."   </p>  
                    <div class='row'>
                        <div class='col-xs-12 col-md-6'>
                            <p class='lead'>
                               ".$row->item_price."</p>	
							  <font size=2> Address: ".$row->address."<br>	
							   Contact No: ".$row->phone_no."</font>					  
					          </div>
					
                    </div>
                </div>
            </div>
        </div>
      <script>
document.getElementById(\"p1\").innerHTML =' Last Update: $row->last_update';
</script>   
									";
								
									
	}
                               } else {
    echo "No Record Found";
}
							
								?>
                    
         
</div>

</script><script src='js/jquery.min.js'></script><script src='js/bootstrap.min.js'></script>
<script >$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});
//# sourceURL=pen.js
</script>
</body></html>