<?php
//logout.php
session_start(); 
session_destroy(); 
header("location: index.php"); 
//comment in Branch A
//working with new code in Branch B

?>