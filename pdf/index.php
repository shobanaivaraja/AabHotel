<?php
include("config.php");
?>
<html>
<head>
<title>How Genrate PDF From MYSQL Usig PHP</title>
</head>
<body>
<p><button type="button" class="primary" onClick="window.open('genratepdf.php','_blank')" >Generate PDF</button></p>
<table border="1">
<tr>
<td style="font-weight:bold;">Id</td>
<td style="font-weight:bold;">Name</td>
<td style="font-weight:bold;">Email</td>
<td style="font-weight:bold;">Mobile</td>
</tr>
<?php 
$sql = "SELECT * from  user";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row) 
	{ ?>

<tr>
<td><?php echo htmlentities($row->id);?></td>
<td><?php echo htmlentities($row->fname);?></td>
<td><?php echo htmlentities($row->emailid);?></td>
<td><?php echo htmlentities($row->phonenumber);?></td>
</tr>

<?php } }
?>
</table>
</body>
</html>
