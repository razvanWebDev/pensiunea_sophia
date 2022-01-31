<?php
//website url needed for forgot password
$website_url = "http://gdarcht.com";

// ONLINE (infinityfree)=============

// $server = 'sql207.epizy.com';
// $username = 'epiz_30934235';
// $password = 's9Rtt1hr8NJz';
// $dbname = 'epiz_30934235_pensiunea_sophia'; 

//LOCAL=================================
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'pensiunea_sophia';    

  $connection = mysqli_connect($server, $username, $password, $dbname);

if (!$connection) {
  die("Failed to connect to MySQL: " . mysqli_connect_error()) ;
}
?>