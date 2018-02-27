<?php
$hostname_conn = "localhost";
$database_conn = "sam";
$username_conn = "root";
$password_conn = "";

$conn = mysqli_connect($hostname_conn, $username_conn, $password_conn,$database_conn) or trigger_error(mysql_error(),E_USER_ERROR);
?>