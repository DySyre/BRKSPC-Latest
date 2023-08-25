<?php
session_start();
$branchdd = $_POST['id'];



$_SESSION['branch_idd'] = $branchdd;

echo $_SESSION['branch_idd'];

include("connect.php");
?>
