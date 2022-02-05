<?php
$site_key = '6LcDIlYeAAAAAK3lDX1ySTuiIpIOMbqoCGvxO04H';
$secret_key = '6LcDIlYeAAAAACOueqDHMYwj5upyutZuEg0k2IWA';
//website url needed for forgot password
$website_url = "http://pensiuneasophia.great-site.net";

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