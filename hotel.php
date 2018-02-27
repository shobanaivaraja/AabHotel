
<!DOCTYPE html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="home.js"></script> 
<style>
h1{
	color:Violet;
	text-transform:capitalize;
	font-weight:600;
}
.checked {
    color: orange;
}

.custab{
    border: 1px solid #ccc;
    padding: 1px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }p.price1{
	 background-color: #4CAF50;;
  color: white;
    padding:5px;
		font-weight:900;
	}
	.address{
	color:black;
	font-weight:600;
	font-size:14px;
	text-transform:capitalize;
}
	p.price{
	 background-color: tomato;
  color: white;
    padding:5px;
		font-weight:900;
	}
	p.cost{
		color: DodgerBlue;
    padding:5px;
	font-weight:900;
	}
th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: MediumSeaGreen;
    color: white;
}
	body{
		font-weight:700;
	}</style>
	</head><body>
	<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	session_start();
	// Connect to the MySQL database  
   $id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	 
require_once"db.php";  
$dynamicList = "";
$imagelist="";
	$query="SELECT * FROM `roomdetails` WHERE `hotelid`='$id'";
	
	$sql = mysqli_query($con,$query);
	$count = mysqli_num_rows($sql); // count the output amount
    if ($count > 0) {
	
		// get all the product details
		$querys="SELECT * FROM `hoteldetails` WHERE `hotelid`='$id'";
		
	$sqls = mysqli_query($con,$querys);
	while($row=mysqli_fetch_array($sqls)){
		$hotelname=$row['hotel_name'];
		$rating=$row['rating'];
			 $name = $row["hotel_name"]; 
			 $door = $row["door_number"];
			 $street=$row['street'];
			 $city=$row['city'];
			 $state=$row['state'];
			 $pin=$row['pincode'];
			 $hrs=$row['check_24_hours'];
			 $restaurant=$row['check_restaurant'];
			 $luggage=$row['check_luggage'];
			 $bar=$row['check_bar'];
			 $extrabed=$row['check_provide_extra_bed'];
			$internet=$row['check_internet'];
			$rooms=$row['check_family_rooms'];
			$nonsmooking=$row['check_non_smoking_rooms'];
			$ac=$row['check_air_conditioning'];
			$breakfast=$row['select_breakfast'];
			$parking=$row['parking'];
			 $location="<i class='fa fa-map-marker' style='color:blue;'></i>&nbsp;".$door." ".$street."<br/>&nbsp;".$city." <br/>&nbsp;".$state." ".$pin;
			 $details=$row['check_family_rooms'];
			 $rating=$row['rating'];

		
$imagelist.='<h1>'.$hotelname.'</h1><table><tr><td valign="top"><img class="img-thumbnail" width="200px" height="350px" src="photos/'.$id.'.jpg" alt="$id"  border="1" /></td><td width="83%">&nbsp;'.rating($rating).'<p class="address">&nbsp;'.$location.'<br/></p>&nbsp;'.$hrs."&nbsp;".$restaurant.'&nbsp;'.$bar.'&nbsp;'.$luggage.'&nbsp;'.$extrabed.'&nbsp;'.$internet.'&nbsp;'.$rooms.'&nbsp;'.$nonsmooking.'&nbsp'.$ac.'&nbsp;'.$breakfast.'&nbsp;'.'</td></tr></table>';
	}
	$i=1;
	while($rows=mysqli_fetch_array($sql)){
		$roomid=$rows['rid'];
 $num_rooms=$rows['no_of_rooms_this_type'];
 $extra_bed=$rows['extra_bed'];
$cloth_rack=$rows['check_cloth_rack'];
$fan=$rows['check_fan'];
$landline=$rows['landline'];
$western=$rows['western'];
 $tub=$rows['tub'];
 $shower=$rows['shower'];
$bedprice=$rows['bedprice'];
 $towels=$rows['check_towels'];
$balcony=$rows['check_balcony'];
$city=$rows['check_city_view'];
$roomprice=$rows['price_per_room'];
$persons=$rows['persons_per_room'];
$gstprice=$rows['gstprice'];
$aminities=$rows['check_cloth_rack']." ".$rows['check_fan']." ".$rows['landline']." ".$rows['western']." ".$rows['tub']." ".$rows['shower']."<br/> ".$rows['check_towels']." ".$rows['check_balcony']." ".$rows['check_city_view'];
	$dynamicList.='<table width="100%" border="0"><tr><td>Room Type &nbsp;'.$i . '<br />'. $aminities . '<br /></td><td>'.$extra_bed.'<br/><p class="cost">Rs.'.$bedprice.'</p></td><td><i class="fa fa-user" style="font-size:20px"></i> &nbsp;'.$persons.'</td><td><b>Room Price</b>&nbsp;Rs.'.$roomprice.'<br/><b>GST Price</b><p class="price">Rs.'.$gstprice.'</p></td></tr></table>';
       $i++; } 
} else {
	$dynamicList = "We have no products listed in our store yet";
	$imagelist="no image"; 
}} else {
	echo "Data to render this page is missing.";
	exit();
}function rating($rating){
				
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
<?php echo $imagelist; 
echo "<p class='price1'>Room Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Extra Bed&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price</p>";
echo $dynamicList; ?></div>
        

</div></div>
