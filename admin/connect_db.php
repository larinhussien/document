<?php
$hostname="localhost";
$username="root";
$password="";
$dbname="asd";
$conn=mysqli_connect($hostname,$username,$password,$dbname);
if(!$conn)
{
    die("connection failed:".mysqli_connect_errno());
}
mysqli_set_charset($conn,"utf8");
