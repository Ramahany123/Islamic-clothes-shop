<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "islamic_clothes_shop";

$con = mysqli_connect($host, $user, $pass, $db);
if ($con->connect_error) {
  die("Connection Failed: " . $con->connect_error);
}
$con->set_charset("utf8");
