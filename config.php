<?php

$host="localhost";
$user="root";
$password="";
$db = "db_mykost";


$conn = mysqli_connect($host,$user,$password,$db);

// check connection
if (mysqli_connect_errno())
{
	echo "Failed To Connect: <br>" . mysqli_connect_error();
}
else
{  
	// echo "Connected <br>"; 
}

?>