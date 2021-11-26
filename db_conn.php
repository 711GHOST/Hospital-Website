<?php
	$conn= mysqli_connect("localhost","root","")or die("Could not connect to host");
	$sql= mysqli_select_db($conn,"hospital_website")or die("unable to connect to database");
?>	