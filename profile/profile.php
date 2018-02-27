 <?php
	include "db.php";
	session_start();
	$id=$_SESSION['id'];
	$img="";$name="";
	$Username=""; 
	$sql="select * from user where `id`='$id'";
	$res=mysqli_query($con,$sql);
	if($row=mysqli_num_rows($res)>0){
		echo "<table>";
		while($val=mysqli_fetch_array($res)){
	$img.='<img class="fb-profile fb-image-profile thumbnail" align="left" src="data:image/jpeg;base64,'.base64_encode( $val['picture'] ).'" />';
$name.=$val['fname']." ".$val['lname'];
		
		$Username.="<div class='fb-profile fb-profile-text city'><h1>".$val['username']."</h1></div>";
			$email=$val['emailid'];
			$mbl=$val['phonenumber'];
			
		}
	
}else{
echo "fail";
}?>
<html>
  <head>
    <title>login</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
<style>


.fb-profile img.fb-image-lg{
    z-index: 0;
    width: 100%;  
    margin-bottom: 10px;
}

.fb-image-profile
{
    margin: -90px 10px 0px 50px;
    z-index: 9;
    width: 20%; 
}

@media (max-width:768px)
{
    
.fb-profile-text>h1{
    font-weight: 700;
    font-size:16px;
	color:red;
}

.fb-image-profile
{
    margin: -45px 10px 0px 25px;
    z-index: 9;
    width: 20%; 
}
} 
.heading{
	color:grey;
	font-weight:900;
	font-size:16px;
	padding-left:8%;
}
.values{
	padding-left:1cm;
	color:blue;
	font-weight:700;
	font-size:16px;
}
.city {
    background-color: powderblue;
    color: white;
    padding: 10px;
	text-transform: capitalize;
} 
fieldset
{ 
hspace:20;	
border:2px solid grey;
    -moz-border-radius:8px;
    -webkit-border-radius:8px;	
    border-radius:8px;	
	
	
}

legend {
  padding: 0.2em 0.5em;
  width:10%;
  color:brown;
  font-size:25px;
  font-weight:800;
  text-align:left;
  }</style>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
 
</head>
 <body>
 <a href="logout.php" >Logout</a>
 <div class="container">
    <div class="fb-profile">
        <img align="left" class="fb-image-lg" src="http://lorempixel.com/850/280/nightlife/5/" alt="Profile image example"/>
        <div align="left" ><?php echo $img; ?></div>
        <div class="fb-profile-text">
            <?php echo $Username;?>
            
        </div> 
    </div>
</div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="file_insert.php" align="left">Change Profile Picture</a>
	<br/>
	<legend>About</legend><?php echo "<span class='heading'>Username: </span><span class='values'>".$name."</span></br/>";
	echo "<span class='heading'>Email: </span><span class='values'>".$email;
		echo "</span></br><span class='heading'>Contact: </span><span class='values'>".$mbl."</span>";
		?><br/>
		<a href="changepass.php" style="padding-left:8%;">Change Password</a><!-- /container -->  