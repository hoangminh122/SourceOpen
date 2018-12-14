<?php
$host="localhost";
$username="root";
$password="";
$database="db_banhang";
$conn=mysqli_connect($host,$username,$password,$database);
mysqli_query($conn,"SET NAMES utf8");
if($conn)
	echo "Ket noi thanh cong";
else
	echo "Ket noi that bai";

?>