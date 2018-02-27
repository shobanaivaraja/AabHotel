 
<!DOCTYPE html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	
<script src="home.js"></script> 
<style>
table, td, th {    
    border: 1px solid #ddd;
    text-align: left;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    padding: 15px;
}
.name{
	color:red;
	font-weight:900;
	font-size:18px;
	text-transform:uppercase;
}.address{
	color:black;
	font-weight:600;
	font-size:14px;
	text-transform:capitalize;
}
.checked {
    color: orange;
}
body{
	line-height:1.2em;
}
a.details:link, a:visited {
    background-color: white;
    color: black;
    border: 2px solid purple;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
	   border-radius: 5px;
}

a.details:hover, a:active {
    background-color: purple;
    color: white;
}
img.image{
	border-radius: 5px;
    border: 2px solid LightGray;
	width:120px;
	height:150px;
}
</style>

  
	</head><body>
	
<?php
require_once"db.php";  
$dynamicList = "";
$locate=$_POST['typeahead'];

$sql = mysqli_query($con,"SELECT * FROM `hoteldetails` where `city`='$locate'");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
             $id = $row["hotelid"];
			 $name = $row["hotel_name"]; 
			 $door = $row["door_number"];
			 $street=$row['street'];
			 $city=$row['city'];
			 $state=$row['state'];
			 $pin=$row['pincode'];
			 $location="<i class='fa fa-map-marker' style='color:blue;'></i>&nbsp;".$door." ".$street."<br/>".$city." <br/>".$state." ".$pin;
			 $details=$row['check_family_rooms'];
			 $rating=$row['rating'];

			 $photos="photos/".$id;
		//	 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
$dynamicList.='<table width="100%" border="1"><tr><td valign="top"><a href="hotel.php?id=' . $id . '"><img class="image" src="photos/'.$id.'.jpg" alt="' . $name . '" /></a></td><td width="83%" valign="top" ><p class="name">' . $name.'</p>'.rating($rating).'<br/><p class="address">'. $location . '</p><br /><a href="hotel.php?id=' . $id . '" class="details">View Price</a></td></tr></table>';
        } 
} else {
	$dynamicList = "We have no products listed in our store yet";
}
function rating($rating){
				
if($rating==1)
	$rte= '<p class="fa fa-star checked"></p>';
elseif($rating==2)
	$rte= '<p class="fa fa-star checked"></p><p class="fa fa-star checked"></p>';
elseif($rating==3)
		$rte= '<p class="fa fa-star checked"></p><p class="fa fa-star checked"></p><p class="fa fa-star checked"></p>';
elseif($rating==4)
	$rte= '<p class="fa fa-star checked"></p><p class="fa fa-star checked"></p><p class="fa fa-star checked"></p><p class="fa fa-star checked"></p>';
elseif($rating=5)
	$rte ='<p class="fa fa-star checked"></p><p class="fa fa-star checked"></p><p class="fa fa-star checked"></p><p class="fa fa-star checked"></p><p class="fa fa-star checked"></p>';
return $rte;
}?>
<div class="container" style="margin-top:40px;width:100%;"><div class="row">
<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
			<?php echo $dynamicList; ?></div>
        

</div></div>
