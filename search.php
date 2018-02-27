<?php
    $key=$_GET['key'];
    $array = array();
   define('DB_HOST', 'localhost:3306'); 
 define('DB_NAME', 'sam'); 
 define('DB_USER','root'); 
 define('DB_PASSWORD',''); 
 $con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) ;
 if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}   $query=$con->query("select * from `user` where `city` LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['city'];
    }
    echo json_encode($array);
?>
