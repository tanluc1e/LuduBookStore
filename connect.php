<?php

//$dbhost= "127.0.0.1:3306";
//$dbuser= "root";
//$dbpass= "mysql";
//$dbname= "ludubs";
//
//if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)) {
//
//    die("failed to connect!");
//}
$conn = new mysqli('localhost', 'tanluc1', 'tanluc1', 'ludubs');
$db = mysqli_connect("localhost", "tanluc1", "tanluc1", "ludubs");