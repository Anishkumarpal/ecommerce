<?php


//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
 $query = "SELECT * FROM Property Where PropertyID != 0 ";
 if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
 {
  $query .= "AND Price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";
 }

 if(isset($_POST["city"]))
 {
  $city_filter = implode("','", $_POST["city"]);
  $query .= "AND City IN('".$city_filter."')";
 }
 if(isset($_POST["sort"]))
 {
$query .= 'AND ORDER BY '.$_REQUEST['sort'];
 }

 
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
     <img src="image/'. $row['Image'] .'" alt="" class="img-responsive" >
     <p align="center"><strong><a href="#">'. $row['Name'] .'</a></strong></p>
     <h4 style="text-align:center;" class="text-danger" >'. $row['Price'] .'</h4>
     <p>Property Type : '. $row['Property_Type'].' <br />
     <p>For : '. $row['Listing_Type'].' <br />
     <p>Living Area : '. $row['Living_area'].' <br />
     <p>City : '. $row['City'].' <br />

    </div>

   </div>
   ';
}
}
else
{
 $output = '<h3>No Data Found</h3>';
}
echo $output;

?>