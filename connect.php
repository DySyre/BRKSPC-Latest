<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(mysqli_connect_errno())
{
        die(mysqli_connect_error());
}


