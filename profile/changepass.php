
<html>  
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head><body><?php
session_start();
if(isset($_POST['submit2']))
{
$id=$_SESSION['id'];
include "db.php";
$pwd=$_POST['pwd'];
$new_pass=$_POST['new_pass'];
$rep_pass=$_POST['rnew_pass'];
	if($rep_pass==$new_pass){
		$sql="select * from user where id='$id'";
		$res=mysqli_query($con,$sql);
		if($res->num_rows>0){
			while($row=mysqli_fetch_array($res))
				$passwd=$row['password'];
		}
		if($pwd==$passwd){
			$sqll = "UPDATE `user` SET `password`='$new_pass' WHERE id='$id'";
			if (mysqli_query($con, $sqll)) {
				echo "<script>alert('Record updated successfully');window.location='logout.php';</script>";
			} else {
				echo "Error updating record: " . mysqli_error($con);
			}	
		}else{		
			echo "<script>alert('Wrong Password');</script>";
	
		}
 	}
	else{
		echo "<script>alert('Password Mismatch');</script>";
	}
$con->close();
}
?>
<h2>Change Password</h2>
<form class="form-inline" method="post" action="">
New password<br/>
<input type="password" name="new_pass" class="form-control"/><br/>
Repeat password<br/>
<input type="password" name="rnew_pass" class="form-control"/><br/>
Old Password<br/>
<input type="password" name="pwd" class="form-control"/><br/>
<div id="demo" style="color:red;"></div><br/>
<button type="submit" class="btn btn-primary pull-left" name="submit2">Submit</button>
</form>

